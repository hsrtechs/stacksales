<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CertificateName extends Model
{
    protected $fillable = ['id_no'];

    public function Category()
    {
        return $this->belongsTo('App\CertificateCategory','certificate_category_id');
    }

    public function Levels()
    {
        return $this->hasMany('App\CertificateLevel');
    }

//    public function Certificates()
//    {
//        return $this->hasManyThrough('App\Certificate','App\CertificateLevel','certificate_name_id','certificate_level_id','id');
//    }

    public function Certificates()
    {
        $certs = [];
        foreach ($this->levels as $level)
        {
            $cert = $level->Certificates->toArray();
            $certs = array_merge($certs,$cert);
        }
        return collect($certs);
    }

}
