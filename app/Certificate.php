<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certificate extends Model
{
    use SoftDeletes;

    protected $appends = ['in'];

    protected $casts = [
        'issue' => 'date',
        'expiry' => 'date',
        'renewal' => 'date',
        'status' => 'boolean',
    ];

    public function getInAttribute()
    {
        return $this->id;
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
        return $this->Role()->Category()->get();
    }

    public function Levels()
    {
        return $this->belongsTo('App\CertificateLevel','certificate_level_id');
    }

    public function Role()
    {
        return $this->Levels->Role;
    }
}
