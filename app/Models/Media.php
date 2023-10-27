<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Media extends Model
{
    use HasFactory;

    protected $fillable = ['created_by', 'updated_by'];

    /**
     * Get the user's upload.
     */
    public function upload()
    {
        return $this->morphOne(Upload::class, 'uploadable');
    }

    /**
     * Get the creator that owns the Media
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by')->select(['id', 'first_name', 'last_name', 'email']);
    }

    /**
     * Get the editor that owns the Media
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function editor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by')->select(['id', 'first_name', 'last_name', 'email']);
    }
}
