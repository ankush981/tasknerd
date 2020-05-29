<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_project_can_have_tasks() 
    {
        $this->signIn();
        $project = factory('App\Project')->create(['owner_id' => auth()->id()]);
        $this->post($project->path() . '/tasks', ['body' => 'Get epic shit done!']);
        $this->get($project->path())
            ->assertSee('epic shit');
    }

    /** @test */
    public function a_task_requires_a_body()
    {
        $this->signIn();
        $project = factory('App\Project')->create(['owner_id' => auth()->id()]);
        $attributes = factory('App\Task')->raw(['body' => '']);
        $this->post($project->path() . '/tasks', $attributes)->assertSessionHasErrors('body');
    }
}
