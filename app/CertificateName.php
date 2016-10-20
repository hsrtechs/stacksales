<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CertificateName extends Model
{
    public function Category()
    {
        return $this->belongsTo('App\CertificateCategory');
    }

    public function Level()
    {
        return $this->hasOne('App\CertificateLevel');
    }
}
