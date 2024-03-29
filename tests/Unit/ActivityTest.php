<?php

namespace Tests\Unit;

use App\Project;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\ProjectFactory;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class ActivityTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    /** @test */
    public function it_has_a_user()
    {
        $user = $this->signIn();

        $project = ProjectFactory::ownedBy($user)->create();

        $this->assertEquals($user->id, $project->activity->first()->user->id);
    }
}
