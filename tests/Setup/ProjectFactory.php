<?php   


namespace Tests\Setup;

use App\Project;
use App\User;
use App\Task;

class ProjectFactory
{
    protected $tasksCount = 0;

    protected $user;

    public function withTasks($count)
    {
        $this->tasksCount = $count;  
        
        return $this; //To smo dodali, da ne vrne try to create on null ((Rešitev!!! to dela zaradi method chaininga))
    }

    public function ownedBy($user)
    {
        $this->user = $user;

        return $this;
    }
    public function create()
    {
        $project = factory(Project::class)->create([
            'owner_id' => $this->user ?? factory(User::class)
        ]);
        
        factory(Task::class, $this->tasksCount)->create([
            'project_id' => $project->id
        ]);

        return $project;
    }
}

