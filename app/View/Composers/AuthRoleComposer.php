<?php

namespace App\View\Composers;

use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthRoleComposer
{
    protected $role;

    /**
     * Create a new profile composer.
     *
     * @return void
     */
    public function __construct()
    {
        if (Auth::check()) {
            if (count(auth()->user()->roles) > 0 && auth()->user()->hasRole(session('role_name'))) {
                $this->role = Role::where('name', session('role_name'))
                    ->with(['permissions'])
                    ->first();
            } else {
                $user = auth()->user();
                $roles = $user->roles()->withTrashed()->get();
                $this->role = $roles[0]->load('permissions');
            }
        }
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with([
            'auth_role' => $this->role
        ]);
    }
}
