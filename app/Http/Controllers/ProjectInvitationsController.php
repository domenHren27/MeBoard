<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectInvitationRequest;
use Illuminate\Http\Request;
use App\Project;
use App\User;

class ProjectInvitationsController extends Controller
{
    public function store(Project $project, ProjectInvitationRequest $request)
    {
        //To smo pospravili v dedicated form request
        // $this->authorize('update', $project); // Glej policy
        // request()->validate([
        //     'email' => ['required','exists:users,email']
        // ], [
        //     'email.exists' => 'The user you are inviting must have a Birdboard account.'
        //]); //Drugi argument je coustume message

        $user = User::whereEmail(request('email'))->first();

        $project->invite($user);


        return redirect($project->path());
    }
}
