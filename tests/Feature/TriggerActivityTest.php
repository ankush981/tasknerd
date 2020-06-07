<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Setup\ProjectFactory;
use Tests\TestCase;

class TriggerActivityTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function creating_a_project()
    {
        $project = app(ProjectFactory::class)->create();
        $this->assertCount(1, $project->activity);
        $this->assertEquals('created', $project->activity[0]->description);
    }

    /** @test */
    public function updating_a_project()
    {
        $project = app(ProjectFactory::class)->create();
        $project->update([
            'title' => 'Changed'
        ]);
        $this->assertCount(2, $project->activity);
        $this->assertEquals('updated', $project->activity->last()->description);
    }

    /** @test */
    public function creating_a_new_task()
    {
        $project = app(ProjectFactory::class)->create();
        $project->addTask('Some task');
        $this->assertCount(2, $project->activity);
        $this->assertEquals('created_task', $project->activity->last()->description);
    }

    /** @test */
    public function completing_a_task()
    {
        $this->withoutExceptionHandling();
        $project = app(ProjectFactory::class)->withTasks(1)->create();
        $this->actingAs($project->owner)
            ->patch($project->tasks[0]->path(), [
                'body' => 'Updated',
                'completed' => true
            ]);
        $this->assertCount(3, $project->activity);
    }

    /** @test */
    public function incompleting_a_task()
    {
        $project = app(ProjectFactory::class)->withTasks(1)->create();
        $this->actingAs($project->owner)
            ->patch($project->tasks[0]->path(), [
                'body' => 'Updated',
                'completed' => true
            ]);
        $this->assertCount(3, $project->activity);
        $this->actingAs($project->owner)
            ->patch($project->tasks[0]->path(), [
                'body' => 'Updated',
                'completed' => false
            ]);
        $project->refresh();
        $this->assertCount(4, $project->activity);
        $this->assertEquals('incompleted_task', $project->activity->last()->description);
    }

    /** @test */
    public function deleting_a_task()
    {
        $project = app(ProjectFactory::class)->withTasks(1)->create();
        $project->tasks[0]->delete();
        $project->refresh();
        $this->assertCount(3, $project->activity);
    }
}
