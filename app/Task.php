<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];

    protected $touches = ['project']; // updates project updated_at too

    protected $casts = [
        'completed' => 'boolean'
    ];

    public function path()
    {
        return $this->project->path() . '/tasks/' . $this->id;
    }

    public function complete() 
    {
        $this->update(['completed' => true]);
        $this->project->recordActivity('completed_task');
    }

    public function incomplete() 
    {
        $this->update(['completed' => false]);
        $this->project->recordActivity('incompleted_task');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
