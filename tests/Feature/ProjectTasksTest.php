<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
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
    public function a_task_can_be_updated()
    {
        $this->signIn();
        $project = factory('App\Project')->create(['owner_id' => auth()->id()]);
        $task = $project->addTask('test task');
        $this->patch($project->path() . '/tasks/' . $task->id, [
            'body' => 'changed',
            'completed' => true,
        ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => true,
        ]); 
    }

    /** @test */
    public function only_the_owner_of_a_project_may_add_tasks()
    {
        $this->signIn();
        $project = factory('App\Project')->create();
        $this->post($project->path() . '/tasks', ['body' => 'My task'])
            ->assertStatus(403);
        $this->assertDatabaseMissing('tasks', ['body' => 'My task']);
    }

    /** @test */
    public function only_the_owner_of_a_project_may_update_a_task()
    {
        $this->signIn();
        $project = factory('App\Project')->create();
        $task = $project->addTask('test task');
        $this->patch($task->path(), ['body' => 'zz'])->assertStatus(403);
        $this->assertDatabaseMissing('tasks', ['body' => 'zz']);
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
