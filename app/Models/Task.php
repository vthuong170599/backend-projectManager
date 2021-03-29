<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['subject', 'status', 'content', 'priority', 'spent_time', 'estimated_time', 'start_date','due_date', 'member_id', 'id_project', 'note'];
}
