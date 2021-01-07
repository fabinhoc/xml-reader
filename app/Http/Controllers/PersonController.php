<?php

namespace App\Http\Controllers;

use App\Repositories\PersonRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class ClientController extends Controller
{
    public function index(PersonRepository $model)
    {
        return $model->all();
    }
}
