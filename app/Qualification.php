<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    public function Levels()
    {
        return $this->belongsToMany('App\QualificationLevel','qualification_levels_relations','level_id','qualification_id');
    }
    public function Categories()
    {
        return $this->belongsToMany('App\QualificationCategory','qualification_categories_relations','category_id','qualification_id');
    }
}
