<?php

namespace Tests\Unit;

use App\User;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;
// use PHPUnit\Framework\TestCase; To zakomentiramo, da lahko delamo s factory

class UserTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function a_user_has_projects()
    {
        $user = factory('App\User')->create();

        $this->assertInstanceOf(Collection::class, $user->projects);
    }

    /** @test */
    public function a_user_has_accessible_projects()
    {
        $domen = $this->signIn();

        ProjectFactory::ownedBy($domen)->create();

        $this->assertCount(1, $domen->allProjects());

        $sally = factory(User::class)->create();
        $nick = factory(User::class)->create();

        $project = tap(ProjectFactory::ownedBy($sally)->create())->invite($nick);

        $this->assertCount(1, $domen->allProjects());

        $project->invite($domen);

        $this->assertCount(2, $domen->allProjects());
    }
}
