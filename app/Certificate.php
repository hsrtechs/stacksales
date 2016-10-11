<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{

    protected $appends = ['in'];

    protected $casts = [
        'issue' => 'date',
        'expiry' => 'date',
    ];

    public function getInAttribute()
    {
        return $this->internal_number;
    }

    function Company()
    {
        return $this->belongsTo('App\Company');
    }
}
