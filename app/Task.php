<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];

    public function path()
    {
        return $this->project->path() . '/tasks/' . $this->id;
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
