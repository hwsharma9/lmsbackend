<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class DatabaseRoute extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['controller_name', 'route', 'named_route', 'method', 'function_name'];

    public function scopeFilter($query, $filter)
    {
        return $query->when(!empty($filter), function ($query) use ($filter) {
            $query->where('controller_name', 'like', '%' . $filter . '%')
                ->orWhere('route', 'like', '%' . $filter . '%')
                ->orWhere('named_route', 'like', '%' . $filter . '%')
                ->orWhere('method', 'like', '%' . $filter . '%')
                ->orWhere('function_name', 'like', '%' . $filter . '%');
        });
    }

    /**
     * Get the permission associated with the DatabaseRoute
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function permission(): HasOne
    {
        return $this->hasOne(Permission::class);
    }
}
