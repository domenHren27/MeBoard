<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use User; Tega ne naredi nikoli več! 

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
