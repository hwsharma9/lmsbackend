<?php

namespace App\Http\Controllers\manage;

use App\Events\AdminAccountCreationEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Admin;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = User::query()->withTrashed()
                ->whereHas('roles', function ($query) {
                    $query->where('name', '=', 'User');
                })
                ->with(['roles' => function ($query) {
                    $query->select(['id', 'name']);
                }]);
            return DataTables::of($data)
                ->addIndexColumn('id')
                ->addColumn('action', function ($row) {
                    $action = view('components.list-actions', [
                        'actions' => [
                            'edit' => 'manage.users.edit',
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
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::backend()->get();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $password = passwordGenerator();
        $validated = $request->validated();
        $validated['password'] = Hash::make($password);
        $user = User::create($validated);
        $user->assignRole($request->role_id);
        AdminAccountCreationEvent::dispatch($user, $password, "Your MP F&D application account created successfully");
        return redirect()->route('manage.users.index')
            ->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::backend()->get();
        return view('admin.users.edit', compact('roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $password = passwordGenerator();
        $validated = $request->validated();
        if ($request->has('password_resend') && $request->password_resend == 1) {
            $validated['password'] = Hash::make($password);
        }
        $user->update($validated);
        if ($request->has('password_resend') && $request->password_resend == 1) {
            AdminAccountCreationEvent::dispatch($user, $password, "Your MP F&D application account updated successfully");
        }
        if (!in_array($request->role_id, $user->roles->pluck('id')->all())) {
            $user->syncRoles($request->role_id);
        }
        return redirect()->route('manage.users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
