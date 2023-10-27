<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use SoftDeletes;

    public $fillable = ['name', 'description', 'guard_name', 'used_for', 'range'];

    public function scopeBackend($query)
    {
        return $query->where('used_for', 'backend');
    }
    public function scopeFrontend($query)
    {
        return $query->where('used_for', 'frontend');
    }
}
