<?php

namespace App\Repositories;

abstract class AbstractRepository {

    protected $model;

    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    protected function resolveModel()
    {
        return app($this->model);
    }

    public function all()
    {
        return $this->model->all();
    }

    public function storeMassivelly(Array $data)
    {
        return response()->json($this->model::insert($data));
    }

    public function store($data)
    {
        return response()->json($this->model::create($data));
    }
}
