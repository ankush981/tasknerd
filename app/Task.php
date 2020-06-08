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
        $this->recordActivity('completed_task');
    }

    public function incomplete() 
    {
        $this->update(['completed' => false]);
        $this->recordActivity('incompleted_task');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function activity() {
        return $this->morphMany(Activity::class, 'subject')->latest();
    }

    public function recordActivity($description)
    {
        // Remember, because of the polymorphic relaionship, this activity will automatically save the name of the parent class as 'App\Task'
        $this->activity()->create([
            'project_id' => $this->project_id,
            'description' => $description,
        ]);
    }
}
