<?php

namespace App\Observers;

use App\Project;

class ProjectObserver
{
    public function created(Project $project)
    {
        $project->recordActivity('created');
    }

    public function updating(Project $project)
    {
        $project->old = $project->getOriginal();
    }

    public function updated(Project $project)
    {
        $project->recordActivity('updated');
    }
}
