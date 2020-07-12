<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Project extends Model
{
    use RecordsActivity; //Trait 

    protected $guarded = [];

    //Data serialization episoda 26 čas 7:16 za več inforamcij. Če tega nebi spremenili test ne deluje
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function path()
    {
        return "/projects/{$this->id}";    
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function addTask($body)
    {
        return $this->tasks()->create(compact('body'));
    }

    public function invite(User $user)
    {
        return $this->members()->attach($user);
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'project_members')->withTimestamps(); //Zadnji argument je coustem ime za pivot table. V kolikor imena ne podamo izbere project_user
    }

    // public function recordActivity($description)
    // {
    //     $this->activity()->create([
    //         'user_id' => $this->owner_id,
    //         'description' => $description,
    //         'changes' => $this->activityChanges(),
    //         'project_id' => class_basename($this) === 'Project' ? $this->id : $this->project_id
    //     ]);
    // }

    public function activity()
    {
        return $this->hasMany(Activity::class)->latest();
    }
}


