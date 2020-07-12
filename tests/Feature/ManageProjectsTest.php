<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;
use App\Project;
use Facades\Tests\Setup\ProjectFactory;

class ManageProjectsTest extends TestCase
{

    use WithFaker, RefreshDatabase; //Pomemben je refresh, da ne shranjuje podatkov v DB

    /** @test */
    public function guests_cannot_controle_projects()
    {
        $project = factory('App\Project')->create();
        

        $this->get('/projects')->assertRedirect('login');
        $this->get('/projects/create')->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
        $this->get($project->path() . '/edit')->assertRedirect('login');
        $this->post('/projects', $project->toArray())->assertRedirect('login');
    }


    /** @test */
    public function a_user_can_create_a_project()
    {
        //$this->withoutExceptionHandling(); Graceful exception handeling. Uporabljaš ko pišeše teste

        $this->actingAs(factory('App\User')->create()); //Ustvari userja, ki bo igral authenticaded userja

        $this->get('/projects/create')->assertStatus(200);

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'notes' => 'General notes here'
        ];

        $resposns = $this->post('/projects', $attributes);
        
        $project = Project::where($attributes)->first();


        $resposns->assertRedirect($project->path());

        $this->get($project->path())
            ->assertSee($attributes['title'])
            ->assertSee($attributes['description'])
            ->assertSee($attributes['notes']);
    }

    /** @test */
    public function a_user_can_see_all_projects_they_have_been_invited_to_on_their_dashboard()
    {
        //user, ki je bil povabljen mora vidit projekt, ki ga je naredil drugi user.
        $user = $this->signIn(); //To bi lahko inlinal spodaj

        $project = tap(ProjectFactory::create())->invite($user); //Tap deluje tako, da nam vrne argument neglede nato kaj potem storimo v njemu glej Tap metodo


        $this->get('/projects')->assertSee($project->title);
    }

    /** @test */
    public function unauthorized_users_cannot_delete_projects()
    {
        $project = ProjectFactory::create();

        $this->delete($project->path())
            ->assertRedirect('/login');

        $this->signIn();

        $this->delete($project->path())
            ->assertStatus(403);

        
    }

    /** @test */
    public function a_user_can_delet_a_project()
    {

        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->delete($project->path())
            ->assertRedirect('/projects');

        $this->assertDatabaseMissing('projects', $project->only('id'));
    }

    /** @test */
    public function a_user_can_update_a_project()
    {
        // $this->signIn();

        $this->withoutExceptionHandling();

        // $project = factory('App\Project')->create(['owner_id' => auth()->id()]); 
        
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)->patch($project->path(), $attributes = [
            'title' => 'Changed',
            'description' => 'Changed',
            'notes' => 'Changed'
        ])->assertRedirect($project->path());

        $this->get($project->path().'/edit')->assertOk();

        $this->assertDatabaseHas('projects', $attributes);
    }

    /** @test */
    public function a_user_can_update_a_projects_general_notes()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)->patch($project->path(), $attributes = [
            'notes' => 'Changed'
        ])->assertRedirect($project->path());

        $this->get($project->path().'/edit')->assertOk();

        $this->assertDatabaseHas('projects', $attributes);       
    }

    /** @test */
    public function a_user_can_view_their_project()
    {        
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->get($project->path())
            ->assertSee($project->title)
            ->assertSee(Str::limit($project->description, 100));
    }

    /** @test */
    public function an_authenticated_user_cannot_view_the_projects_of_others()
    {
        $this->signIn(); //Acting user

        // $this->withoutExceptionHandling();

        $project = factory('App\Project')->create();
        
        $this->get($project->path())->assertStatus(403);
    }

    /** @test */
    public function an_authenticated_user_cannot_update_the_projects_of_others()
    {
        $this->signIn(); //Acting user

        // $this->withoutExceptionHandling();

        $project = factory('App\Project')->create();
        
        $this->patch($project->path())->assertStatus(403);
    }

    /** @test */
    public function a_project_requires_a_title()
    {
        $this->signIn(); //Ustvari userja, ki bo igral authenticaded userja

        $attributes = factory('App\Project')->raw(['title' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_project_requires_a_description()
    {
        $this->signIn(); //Ustvari userja, ki bo igral authenticaded userja

        $attributes = factory('App\Project')->raw(['description' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }

    
}
