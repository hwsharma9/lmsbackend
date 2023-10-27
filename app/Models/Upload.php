<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;

    protected $fillable = ['uploadable_id', 'uploadable_type', 'file_type', 'file_path', 'folder', 'original_name'];

    /**
     * Get the parent uploadable model (Admin, User or media).
     */
    public function uploadable()
    {
        return $this->morphTo();
    }
}
