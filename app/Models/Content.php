<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = [
        'module_id', 'title', 'video_source_type', 'video_url', 'video_length'
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}

