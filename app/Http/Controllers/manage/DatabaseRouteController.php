<?php

namespace App\Http\Controllers\manage;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDatabaseRouteRequest;
use App\Http\Requests\UpdateDatabaseRouteRequest;
use App\Models\DatabaseRoute;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DatabaseRouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = DatabaseRoute::query()
                ->withTrashed();
            return DataTables::of($data)
                ->addIndexColumn('id')
                ->addColumn('action', function ($row) {
                    $action = view('components.list-actions', [
                        'actions' => [
                            'edit' => 'manage.databaseroutes.edit'
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
        return view('admin.database_routes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.database_routes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDatabaseRouteRequest $request)
    {
        $routes = [];
        if (count($request->route) > 0) {
            foreach ($request->route as $key => $route) {
                $routes[] = [
                    'controller_name' => $request->controller_name,
                    'resides_at' => $request->resides_at,
                    'route' => $request->route[$key],
                    'named_route' => $request->named_route[$key],
                    'method' => $request->method[$key],
                    'function_name' => $request->function_name[$key],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
        DatabaseRoute::insert($routes);
        return redirect()->route('manage.databaseroutes.index')
            ->with('success', count($routes) . ' new Database routes created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DatabaseRoute  $databaseroute
     * @return \Illuminate\Http\Response
     */
    public function show(DatabaseRoute $databaseroute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DatabaseRoute  $databaseroute
     * @return \Illuminate\Http\Response
     */
    public function edit(DatabaseRoute $databaseroute)
    {
        return view('admin.database_routes.edit', compact('databaseroute'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DatabaseRoute  $databaseroute
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDatabaseRouteRequest $request, DatabaseRoute $databaseroute)
    {
        return $request->validated();
        $databaseroute->fill($request->validated());
        $databaseroute->save();
        return redirect()->route('manage.databaseroutes.index')
            ->with('success', 'Database route updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DatabaseRoute  $databaseroute
     * @return \Illuminate\Http\Response
     */
    public function destroy(DatabaseRoute $databaseroute)
    {
        //
    }

    public function getDatabaseroutes(Request $request)
    {
        // ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = DatabaseRoute::withTrashed()
            ->select('count(*) as allcount')->count();
        $totalRecordswithFilter = DatabaseRoute::withTrashed()
            ->select('count(*) as allcount')
            ->filter($searchValue)->count();

        // Fetch records
        $records = DatabaseRoute::withTrashed()
            ->orderBy($columnName, $columnSortOrder)
            ->filter($searchValue)
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "data" => $records
        );
        return $response;
    }
}
