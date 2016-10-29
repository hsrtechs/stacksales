<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certificate extends Model
{
    use SoftDeletes;

    protected $appends = ['in'];

    protected $fillable = ['id_no'];
    protected $dates = ['deleted_at','issue','expiry','renewal','dob'];

    protected $casts = [
        'status' => 'boolean',
        'gender' => 'boolean',
    ];

    public function getInAttribute()
    {
        return $this->id_no;
        return  str_pad($this->id,4,'0',STR_PAD_LEFT);
    }

    public function getStatusAttribute($value)
    {
        return $value == false ? 'Inactive' : 'Active';
    }

    /**
     | Query Scopes
     */

    public function scopeActive($query)
    {
        return $query->where('status','=','1');
    }


    /**
     | Some Custom methods to favorable to the code to run in views.
     */

    public function Role()
    {
        return $this->Levels->Role;
    }

    public function Category()
    {
        return $this->Role()->Category()->get();
    }

    /**
     *  Relations ships to other models
    */

    public function Company()
    {
        return $this->belongsTo('App\Company');
    }

    public function Levels()
    {
        return $this->belongsTo('App\CertificateLevel','certificate_level_id');
    }

    public function scopeGetAll($query)
    {
        return $query->join('certificate_levels','certificates.certificate_level_id','=','certificate_levels.id')
            ->join('certificate_names','certificate_names.id','certificate_levels.certificate_name_id')
            ->join('certificate_categories','certificate_names.certificate_category_id','=','certificate_categories.id');
    }

    public function scopeGetCertData($query)
    {
        return $query->select('certificates.*','certificate_categories.name as category','certificate_names.name as role');
    }

    public function scopeIncludeRole($query)
    {
        return $query->join('certificate_levels','certificates.certificate_level_id','=','certificate_levels.id')
            ->join('certificate_names','certificate_names.id','certificate_levels.certificate_name_id')
            ->select('certificates.*','certificate_names.name as role','certificate_levels.name as level',
                'certificate_levels.id as level_id','certificate_names.id as role_id',
                'certificate_names.certificate_category_id as category_id');
    }
}
