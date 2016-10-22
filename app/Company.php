<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    protected $appends = ['in','cert'];

    public function Certificates()
    {
        return $this->hasMany('App\Certificate');
    }

    public function getInAttribute()
    {
        return $this->id;
    }

    public function getQualificationAttribute($value)
    {
        return json_decode($value);
    }

}
