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
        return $this->hasMany(\App\Shiporder::class);
    }

    public function phones()
    {
        return $this->hasMany(\App\Phone::class);
    }
}
