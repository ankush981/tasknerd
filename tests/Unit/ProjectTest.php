<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_path()
    {
        $project = factory('App\Project')->create();
        $this->assertEquals('/projects/' . $project->id, $project->path());
    }

    /** @test */
    public function a_model_belongs_to_an_owner() {
        $project = factory('App\Project')->create();
        $this->assertInstanceOf(User::class, $project->owner);
    }
}
