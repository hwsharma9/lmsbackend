<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Permission as ModelsPermission;

class Permission extends ModelsPermission
{
    use HasFactory, SoftDeletes;

    /**
     * Get the databaseRoute that owns the Permission
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function databaseRoute(): BelongsTo
    {
        return $this->belongsTo(DatabaseRoute::class);
    }
}
