<?php

namespace App\Http\Controllers\manage;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Models\AdminMenu;
use App\Models\DatabaseRoute;
use App\Models\Permission;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Queue\Jobs\DatabaseJob;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        // $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'store']]);
        // $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $data = Role::query()->withTrashed();
            return DataTables::of($data)
                ->addIndexColumn('id')
                ->addColumn('action', function ($row) {
                    $action = view('components.list-actions', [
                        'actions' => [
                            'edit' => 'manage.roles.edit',
                        ],
                        'model' => $row
                    ]);
                    $action = $action->render();

                    return $action;
                })
                ->editColumn('updated_at', function ($row) {
                    return date('Y-m-d', strtotime($row['updated_at']));
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();
        $menus = AdminMenu::where('p_menu_id', 0)->get();
        return view('admin.roles.create', compact('permission', 'menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        $validated = $request->validated();
        $validated['range'] = implode(',', $validated['range']);
        $role = Role::create($validated);
        // $role->syncPermissions($request->input('permission'));

        return redirect()->route('manage.roles.index')
            ->with('success', 'Role created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();

        return view('admin.roles.show', compact('role', 'rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::withTrashed()->find($id);
        // return $role;
        // $permission = Permission::whereHas('databaseRoute')->with(['databaseRoute'])->get();
        // return $permission->pluck('databaseRoute');
        // $menus = AdminMenu::where('p_menu_id', 0)->get();
        // return $menus;
        $rolePermissions = []; //DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
        //     ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
        //     ->all();
        $routes = DatabaseRoute::whereHas('permission')->with(['permission'])->select(['id', 'controller_name'])->get();
        $group_routes = $routes->groupBy('controller_name');
        // return $group_routes;
        return view('admin.roles.edit', compact('role', 'rolePermissions', 'group_routes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $validated = $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'range' => 'required',
            'used_for' => 'required',
        ]);

        $validated['range'] = implode(',', $validated['range']);
        $role->update($validated);
        $permissions = AdminMenu::whereHas('permission')->with(['permission'])->find(explode(",", $validated['range']));
        // $permissions_array = array_unique(array_merge($permissions->pluck('permission.id')->all(), array_map('intval', $request->other_permissions)));
        $permissions_array = array_map('intval', $request->other_permissions);
        // return [$validated['range'], $permissions_array];
        $role->syncPermissions($permissions_array);
        if ($request->has('deleted_at') && $request->get('deleted_at') == 'on') {
            $validated['deleted_at'] = Carbon::now()->format('Y-m-d H:i:s');
            $role->delete();
        } else {
            // $validated['deleted_at'] = null;
            $role->restore();
        }

        return redirect()->route('manage.roles.index')
            ->with('success', 'Role updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id', $id)->delete();
        return redirect()->route('manage.roles.index')
            ->with('success', 'Role deleted successfully');
    }

    // public function getRoles(Request $request)
    // {
    //     // ## Read value
    //     $draw = $request->get('draw');
    //     $start = $request->get("start");
    //     $rowperpage = $request->get("length"); // Rows display per page

    //     $columnIndex_arr = $request->get('order');
    //     $columnName_arr = $request->get('columns');
    //     $order_arr = $request->get('order');
    //     $search_arr = $request->get('search');

    //     $columnIndex = $columnIndex_arr[0]['column']; // Column index
    //     $columnName = $columnName_arr[$columnIndex]['data']; // Column name
    //     $columnSortOrder = $order_arr[0]['dir']; // asc or desc
    //     $searchValue = $search_arr['value']; // Search value

    //     // Total records
    //     $totalRecords = Role::withTrashed()->select('count(*) as allcount')->count();
    //     $totalRecordswithFilter = Role::withTrashed()->select('count(*) as allcount')->where('name', 'like', '%' . $searchValue . '%')->count();

    //     // Fetch records
    //     $records = Role::withTrashed()->orderBy($columnName, $columnSortOrder)
    //         ->where('name', 'like', '%' . $searchValue . '%')
    //         ->skip($start)
    //         ->take($rowperpage)
    //         ->get();

    //     $response = array(
    //         "draw" => intval($draw),
    //         "iTotalRecords" => $totalRecords,
    //         "iTotalDisplayRecords" => $totalRecordswithFilter,
    //         "data" => $records
    //     );
    //     return $response;
    // }
}
