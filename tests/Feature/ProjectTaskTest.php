<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Project;
//use Tests\Setup\ProjectFactory;
use Facades\Tests\Setup\ProjectFactory; // Dodal smo facade prefix, da simulira facade "magic"

class ProjectTaskTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function a_project_can_have_tasks()
    {
        //Tako bi delovalo brez implementacije Project factory
        // $this->signIn();

        // $project = auth()->user()->projects()->create($project);

        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->post($project->path() . '/tasks', ['body' => 'Test task']);

        $this->get($project->path())
            ->assertSee('Test task');
    }

    /** @test */
    public function a_task_can_be_updated()
    {
        $project = ProjectFactory::withTasks(1)
            ->create();

        $this->actingAs($project->owner)->patch($project->tasks->first()->path(), [
            'body' => 'changed',
            'completed' => true
        ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => true
        ]);
    }

     /** @test */
     public function a_task_can_be_completed()
     {
         $project = ProjectFactory::withTasks(1)
             ->create();
 
         $this->actingAs($project->owner)->patch($project->tasks->first()->path(), [
             'body' => 'changed',
             'completed' => true
         ]);
 
         $this->assertDatabaseHas('tasks', [
             'body' => 'changed',
             'completed' => true
         ]);
     }

     /** @test */
     public function a_task_can_be_marked_as_incomplete()
     {
         $this->withoutExceptionHandling();
         $project = ProjectFactory::withTasks(1)
             ->create();
 
         $this->actingAs($project->owner)->patch($project->tasks->first()->path(), [
             'body' => 'changed',
             'completed' => true
         ]);

         $this->patch($project->tasks->first()->path(), [
            'body' => 'changed',
            'completed' => false
        ]);
 
         $this->assertDatabaseHas('tasks', [
             'body' => 'changed',
             'completed' => false
         ]);
     }

    /** @test */
    public function only_the_owner_of_a_project_may_add_tasks()
    {
        $this->signIn();

        $project = factory('App\Project')->create();

        $this->post($project->path() . '/tasks', ['body' => 'Test task']);

        $this->assertDatabaseMissing('tasks', ['body' => 'Test task']);
    }

    /** @test */
    public function only_the_owner_of_a_project_may_update_task()
    {
        $this->signIn();

        $project = ProjectFactory::withTasks(1)->create();

        $this->patch($project->tasks[0]->path(), ['body' => 'changed'])
            ->assertStatus(403)
        ;

        $this->assertDatabaseMissing('tasks', ['body' => 'Test task']);
    }

    /** @test */
    public function a_task_requires_a_body()
    {
        $project = ProjectFactory::create();

        $attributes = factory('App\Task')->raw(['body' => '']);

        $this->actingAs($project->owner)
            ->post($project->path() . '/tasks', $attributes)->assertSessionHasErrors('body');
    }
}
