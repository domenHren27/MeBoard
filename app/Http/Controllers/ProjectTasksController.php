<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Task;

class ProjectTasksController extends Controller
{
    public function store(Project $project)
    {   
        $this->authorize('update', $project);
        // if (auth()->user()->isNot($project->owner)) {
        //     abort(403);
        // }

        request()->validate(['body' => 'required']);
        $project->addTask(request('body'));

        return redirect($project->path());
    }

    public function update(Project $project, Task $task)
    {
        $this->authorize('update' , $task->project);
        // if (auth()->user()->isNot($task->project->owner)) {
        //     abort(403);
        // }

        $attributes = request()->validate(['body' => 'required']);

        $task->update($attributes);

        request('completed') ? $task->complete() : $task->incomplete();

        // if (request('completed')) {
        //     $task->complete();
        // } else {
        //     $task->incomplete();
        // }

        // $task->update([
        //     'body' => request('body'),
        //     'completed' => request()->has('completed') //Pri chekboxih moramo upoštevati, da če ne checkamo ne pošlje tega čez
        // ]);

        return redirect($project->path());
        
    }
}
