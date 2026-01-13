<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
     protected $fillable = [
        'project_id',
        'title',
        'type',
        'issued_at',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
