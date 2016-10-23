<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CertificateCategory extends Model
{
    public function Roles()
    {
        return $this->hasMany('App\CertificateName');
    }

    public function Certificates()
    {
        $certs = collect();
        foreach ($this->roles as $role)
        {
            $certs = $certs->merge(($role->Certificates()->toArray()));

        }
        return $certs;
    }

}
