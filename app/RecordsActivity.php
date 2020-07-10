<?php

namespace App;

use Illuminate\Support\Arr;


trait RecordsActivity {

    public $oldAttributes = [];


    //Ta nadomešča stvari v observerju, to storimo za to, da se ne ponavljamo
    public static function bootRecordsActivity() //convention za trait E:27
    { 
        foreach (self::recordableEvents() as $event) {
            static::$event(function ($model) use ($event) {
                
                $model->recordActivity($model->activityDescription($event));
            });

            if ($evnet = 'updated') {
                static::updating(function ($model) {
                    $model->oldAttributes = $model->getOriginal();
                }); 
            }
            
        }
    }

    protected function activityDescription($description) 
    {

        return "{$description}_" . strtolower(class_basename($this)); // created_task;
        
    }

    protected static function recordableEvents()
    {
        if (isset(static::$recordableEvents)) {
            return static::$recordableEvents;
        } 
            return ['created', 'updated', 'deleted'];
    }

    public function recordActivity($description)
    {
        $this->activity()->create([
            'user_id' => ($this->project ?? $this)->owner->id,
            'description' => $description,
            'changes' => $this->activityChanges(),
            'project_id' => class_basename($this) === 'Project' ? $this->id : $this->project_id
        ]);
    }

    

    public function activityChanges()
    {
        if ($this->wasChanged()) {
            return [
                'before' => Arr::except(array_diff($this->oldAttributes, $this->getAttributes()), 'updated_at'),
                'after' => Arr::except($this->getChanges(), 'updated_at') //getChanges deluje samo, če ga presistamo v bazo podatkov
            ];
        }        
    }

    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject')->latest();
    }    

}