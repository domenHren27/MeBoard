<?php

namespace App;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Project extends Model
{
    protected $guarded = [];

    public $old = [];

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

    public function recordActivity($description)
    {
        $this->activity()->create([
            'description' => $description,
            'changes' => $this->activityChanges($description) 
        ]);
    }

    public function activityChanges($description)
    {
        if ($description == 'updated') {
            return [
                'before' => Arr::except(array_diff($this->old, $this->getAttributes()), 'updated_at'),
                'after' => Arr::except($this->getChanges(), 'updated_at') //getChanges deluje samo, če ga presistamo v bazo podatkov
            ];
        }        
    }

    public function activity()
    {
        return $this->hasMany(Activity::class)->latest();
    }
}


