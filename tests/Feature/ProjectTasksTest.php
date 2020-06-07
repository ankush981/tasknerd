<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Setup\ProjectFactory;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_project_can_have_tasks() 
    {
        $project = app(ProjectFactory::class)->create();
        $this->actingAs($project->owner)->post($project->path() . '/tasks', ['body' => 'Get epic shit done!']);
        $this->get($project->path())
            ->assertSee('epic shit');
    }

    /** @test */
    public function a_task_can_be_updated()
    {
        $project = app(ProjectFactory::class)
            ->withTasks(1)
            ->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks[0]->path(), [
            'body' => 'changed',
        ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
        ]); 
    }

    /** @test */
    public function a_task_can_be_completed()
    {
        $project = app(ProjectFactory::class)
            ->withTasks(1)
            ->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks[0]->path(), [
            'body' => 'changed',
            'completed' => true,
        ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => true,
        ]); 
    }

    /** @test */
    public function a_task_can_be_marked_as_incomplete()
    {
        $project = app(ProjectFactory::class)
            ->withTasks(1)
            ->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks[0]->path(), [
            'body' => 'changed',
            'completed' => true,
        ]);

        $this->actingAs($project->owner)
            ->patch($project->tasks[0]->path(), [
            'body' => 'changed',
            'completed' => false,
        ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => false,
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
        $project = app(ProjectFactory::class)->withTasks(1)->create();
        $task = $project->tasks->first();
        $this->patch($task->path(), ['body' => 'zz'])->assertStatus(403);
        $this->assertDatabaseMissing('tasks', ['body' => 'zz']);
    }

    /** @test */
    public function a_task_requires_a_body()
    {
        $project = app(ProjectFactory::class)->create();
        $attributes = factory('App\Task')->raw(['body' => '']);
        $this->actingAs($project->owner)
            ->post($project->path() . '/tasks', $attributes)
            ->assertSessionHasErrors('body');
    }
}
