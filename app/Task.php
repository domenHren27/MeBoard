<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];

    protected $touches = ['project']; //Če spremenimo task se dotaknemo project. To se vidi pri updated at.

    //castamo completed v boolean
    protected $casts = [
        'completed' => 'boolean'
    ];

    //To bi lahko dali v Observer, je le eden od možnih načinov
    protected static function boot()
    {
        parent::boot();

        static::created(function ($task) {
            $task->project->recordActivity('created_task');
            // Activity::create([
            //     'project_id' => $task->project->id,
            //     'description' => 'created_task'
            // ]);
        });

        static::updated(function ($task) {
            if (! $task->completed) return;
           
            $task->project->recordActivity('completed_task');
            // Activity::create([
            //     'project_id' => $task->project->id,
            //     'description' => 'completed_task'
            // ]);
        });
    }
    
    public function complete()
    {
        $this->update(['completed' => true]);       
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function path()
    {
        return "/projects/{$this->project->id}/tasks/{$this->id}";
    }
}
