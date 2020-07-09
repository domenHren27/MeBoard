<?php

namespace App;

use Illuminate\Support\Arr;

trait RecordsActivity {

    public $old = [];

    public function recordActivity($description)
    {
        $this->activity()->create([
            'description' => $description,
            'changes' => $this->activityChanges(),
            'project_id' => class_basename($this) === 'Project' ? $this->id : $this->project_id
        ]);
    }

    public function activityChanges()
    {
        if ($this->wasChanged()) {
            return [
                'before' => Arr::except(array_diff($this->old, $this->getAttributes()), 'updated_at'),
                'after' => Arr::except($this->getChanges(), 'updated_at') //getChanges deluje samo, če ga presistamo v bazo podatkov
            ];
        }        
    }

}