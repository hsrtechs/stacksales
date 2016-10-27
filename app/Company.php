<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Company extends Model
{
    use SoftDeletes;

    protected $appends = ['in','cert','level','category'];

    protected $dates = ['deleted_at'];

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

    public function getLevelAttribute()
    {
        $levels = $this->qualification->level;

        $l = [];
        foreach ($levels as $level)
        {
            $lv = DB::table('certificate_levels')->where('id',$level)->pluck('name')->first();
            array_push($l,$lv);
        }
        return implode(', ',$l);
    }

    public function getCategoryAttribute()
    {
        return DB::table('certificate_categories')->where('id',$this->qualification->cat)->pluck('name')->first();
    }



}
