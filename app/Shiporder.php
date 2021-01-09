<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shiporder extends Model
{
    protected $table = 'shiporders';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'person_id',
        'shipto_name',
        'shipto_address',
        'shipto_city',
        'shipto_country'
    ];

    public function person()
    {
        return $this->belongsTo(\App\Person::class, 'id', 'person_id');
    }
}
