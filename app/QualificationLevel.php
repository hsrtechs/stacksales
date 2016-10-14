<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QualificationLevel extends Model
{

    public $timestamps = false;

    public function Qualifications()
    {
        return $this->belongsToMany('App\Qualification','qualification_levels_relations','level_id','qualification_id');
    }
}
