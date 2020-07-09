<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $guarded = [];

    protected $casts = [ //Izredno pomembno za zapis v bazo ali iz nje 
        'changes' => 'array'
    ];

    public function subject()
    {
        return $this->morphTo();
    }
}
