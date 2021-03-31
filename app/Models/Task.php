<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['subject', 'status', 'content', 'priority', 'spent_time', 'estimated_time', 'start_date', 'due_date', 'member_id', 'id_project', 'note'];

    /**
     *  get user insert to data Task
     * @return Array user
     */
    public function Member()
    {
        return $this->belongsTo(User::class, 'member_id');
    }

    /**
     *  get project insert to data Task
     * @return Array project
     */
    public function Project()
    {
        return $this->belongsTo(Project::class, 'id_project');
    }

    /**
     * search Task
     * @param String subject
     * @return Array Task 
     */
    public function search($subject)
    {
        return Task::where('subject', 'like', "%{$subject}%")->with(['Member', 'Project'])->get()->toArray();
    }
}
