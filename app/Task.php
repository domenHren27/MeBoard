<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Activity;

class Task extends Model
{
    protected $guarded = [];

    protected $touches = ['project']; //Če spremenimo task se dotaknemo project. To se vidi pri updated at.

    //castamo completed v boolean
    protected $casts = [
        'completed' => 'boolean'
    ];
    //** POZOR SPODAJ JE NADOMESTEK OBSERVERJA !!!  */
    //To bi lahko dali v Observer, je le eden od možnih načinov
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::created(function ($task) {
    //         $task->project->recordActivity('created_task');
    //         // Activity::create([
    //         //     'project_id' => $task->project->id,
    //         //     'description' => 'created_task'
    //         // ]);
    //     });

    //     static::deleted(function ($task) {
    //         $task->project->recordActivity('deleted_task');
    //         // Activity::create([
    //         //     'project_id' => $task->project->id,
    //         //     'description' => 'created_task'
    //         // ]);
    //     });

    //     static::updated(function ($task) {
    //         if (! $task->completed) return;
           
    //         $task->project->recordActivity('completed_task');
    //         // Activity::create([
    //         //     'project_id' => $task->project->id,
    //         //     'description' => 'completed_task'
    //         // ]);
    //     });
    // }
    
    public function complete()
    {
        $this->update(['completed' => true]);
        
        $this->recordActivity('completed_task');
    }

    public function incomplete()
    {
        $this->update(['completed' => false]);
        
        $this->recordActivity('incompleted_task');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function path()
    {
        return "/projects/{$this->project->id}/tasks/{$this->id}";
    }

    public function recordActivity($description)
    {
        $this->activity()->create([
            'project_id' => $this->project_id,
            'description' => $description
        ]);
        // Activity::create([
        //     'project_id' => $this->id,
        //     'description' => $type
        // ]);
    }

    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject')->latest();
    }    

}
