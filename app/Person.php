<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'people';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function shiporders()
    {
        return $this->belongsTo(\App\Shiporder::class, 'id', 'person_id');
    }

    public function phones()
    {
        return $this->belongsTo(\App\Phone::class, 'id', 'person_id');
    }
}
