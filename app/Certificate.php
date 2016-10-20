<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{

    protected $appends = ['in'];

    protected $casts = [
        'issue' => 'date',
        'expiry' => 'date',
        'renewal' => 'date',
        'status' => 'boolean',
    ];

    public function getInAttribute()
    {
        return $this->internal_number;
    }

    public function getStatusAttribute($value)
    {
        return $value == false ? 'Inactive' : 'Active';
    }

    public function Company()
    {
        return $this->belongsTo('App\Company');
    }

    public function Category()
    {
        return $this->hasManyThrough('App\CertificateCategory','App\CertificateName');
    }

    public function Levels()
    {
        return $this->belongsTo('App\CertificateLevel','id');
    }

    public function Role()
    {
        return $this->hasManyThrough('App\CertificateName','App\CertificateLevel','certificate_name_id','id','certificate_level_id');
    }
}
