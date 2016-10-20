<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CertificateCategory extends Model
{
    public function Roles()
    {
        return $this->hasMany('App\CertificateName');
    }
}
