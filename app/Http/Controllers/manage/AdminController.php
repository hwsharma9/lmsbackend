<?php

namespace App\Http\Controllers\manage;

use App\Events\AdminAccountCreationEvent;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Admin::query()
                ->withTrashed()
                ->with(['roles' => function ($query) {
                    $query->select(['id', 'name']);
                }]);
            return DataTables::of($data)
                ->addIndexColumn('id')
                ->addColumn('action', function ($row) {
                    $action = view('components.list-actions', [
                        'actions' => [
                            'edit' => 'manage.admins.edit',
                        ],
                        'model' => $row
                    ]);
                    $action = $action->render();

                    return $action;
                })
                ->editColumn('updated_at', function ($row) {
                    return date('Y-m-d', strtotime($row['updated_at']));
                })
                ->editColumn('status', function ($row) {
                    return DisplayStatus($row['status']);
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        return view('admin.admins.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::backend()->get();
        return view('admin.admins.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdminRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminRequest $request)
    {
        $password = passwordGenerator();
        $validated = $request->validated();
        $validated['password'] = Hash::make($password);
        $admin = Admin::create($validated);
        // info($admin->id);
        $admin->assignRole($request->role_id);
        AdminAccountCreationEvent::dispatch($admin, $password, "Your MP F&D application account created successfully");
        return redirect()->route('manage.admins.index')
            ->with('success', 'Admin created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        $roles = Role::backend()->get();
        return view('admin.admins.edit', compact('roles', 'admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdminRequest  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        $roles = Role::backend()->get();
        $password = passwordGenerator();
        $validated = $request->validated();
        if ($request->has('password_resend') && $request->password_resend == 1) {
            $validated['password'] = Hash::make($password);
        }
        $admin->update($validated);
        if ($request->has('password_resend') && $request->password_resend == 1) {
            AdminAccountCreationEvent::dispatch($admin, $password, "Your MP F&D application account updated successfully");
        }
        if (count(array_diff($roles->pluck('id')->all(), $request->role_id)) > 0) {
            $admin->syncRoles($request->role_id);
        }
        return redirect()->route('manage.admins.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
