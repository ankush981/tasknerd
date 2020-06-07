<?php

namespace App\Observers;

use App\Project;
use App\Activity;

class ProjectObserver
{
    public function created(Project $project)
    {
        $this->recordActivity('created', $project);
    }

    public function updated(Project $project)
    {
        $this->recordActivity('updated', $project);
    }

    protected function recordActivity($type, $project)
    {
        Activity::create([
            'project_id' => $project->id,
            'description' => $type
        ]);
    }
}
