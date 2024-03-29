<?php

namespace App\Policies;

use App\User;
use App\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function manage(User $user, Project $project)
    {
        return $user->is($project->owner);        
    }

    public function update(User $user, Project $project)
    {
        return $user->is($project->owner) || $project->members->contains($user); // Če je owner dovoli ali če je v memeberjih dovoli   
    }
}
