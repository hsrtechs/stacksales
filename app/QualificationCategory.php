<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QualificationCategory extends Model
{

    public $timestamps = false;

    public function Qualifications()
    {
        return $this->belongsToMany('App\Qualification','qualification_categories_relations','qualification_id','category_id');
    }

    public function Levels()
    {
        return $this->hasManyThrough('App\QualificationLevel','App\Qualification','level_id','qualification_id','id');
    }
}
