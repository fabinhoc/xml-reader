<?php

namespace App\Repositories;
use App\Person;

class PersonRepository extends AbstractRepository {
    
    protected $model = Person::class;
    
}