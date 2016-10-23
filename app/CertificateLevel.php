<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CertificateLevel extends Model
{
    public function Role()
    {
        return $this->belongsTo('App\CertificateName','id');
    }

    public function Certificates()
    {
        return $this->hasMany('App\Certificate');
    }
}
