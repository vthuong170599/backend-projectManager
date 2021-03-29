<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'name',
        'desc',
        'start_date'

    ];
    // protected $casts = [
    //     'position' => 'array',
    // ];
    protected $primaryKey = 'id';
    protected $table = 'projects';
}
