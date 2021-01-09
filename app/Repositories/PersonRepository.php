<?php

namespace App\Repositories;
use App\Person;

class PersonRepository extends AbstractRepository {
    
    protected $model = Person::class;

    public function findAll()
    {
        $resource = $this->model::with('phones')
            ->with('shiporders')
            ->get();

        return response()->json($resource);
    }

}