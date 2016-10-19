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
        return $this->belongsTo('App\CertificateCategory');
    }

    public function Levels()
    {
        return $this->belongsTo('App\CertificateLevel');
    }
}
