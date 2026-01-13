<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'code',
        'floor',
        'area_m2',
        'rooms',
        'price_eur',
        'status'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
