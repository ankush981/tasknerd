<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Project extends Model
{
    public $guarded = [];

    public $old = []; // old attributes, before saving

    public function path() {
        return '/projects/' . $this->id;
    }

    public function owner() {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function tasks() {
        return $this->hasMany(Task::class);
    }

    public function addTask($body) {
        return $this->tasks()->create(['body' => $body]);
    }

    public function recordActivity($description)
    {
        $this->activity()->create([
            'description' => $description,
            'changes' => $this->activityChanges()
        ]);
    }

    public function activityChanges() 
    {
        if($this->wasChanged()) {
            return [
                'before' => Arr::except(array_diff($this->getAttributes(), $this->old), 'updated_at'),
                'after' => Arr::except($this->getChanges(), 'updated_at')
            ];
        }
    }

    public function activity() 
    {
        return $this->hasMany(Activity::class)->latest();
    }
}
