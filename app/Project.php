<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public $guarded = [];

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
}
