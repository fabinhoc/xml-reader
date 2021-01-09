<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $table = 'phones';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'phone', 'person_id'
    ];

    public function person()
    {
        return $this->belongsTo(\App\Person::class, 'id', 'person_id');
    }
}
