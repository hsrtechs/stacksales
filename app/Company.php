<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    protected $appends = ['in','cert'];

    public function Certificates()
    {
        return $this->hasMany('App\Certificate');
    }

    public function getInAttribute()
    {
        return $this->internal_number;
    }

    public function getQualificationAttribute($value)
    {
        return json_decode($value);
    }

}
