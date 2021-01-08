<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Repositories\PersonRepository;
use Illuminate\Http\Request;
use App\Services\XMLStore;
use App\Services\XMLReader;
use App\Services\StoreData;

class PersonController extends Controller
{
    public function index(PersonRepository $model)
    {
        return $model->all();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:xml'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->all(), 400);
        }

        if (!$request->hasFile('file')) {
            return response()->json('File not found', 400);
        }

        $storeData = new StoreData();
        
        return $storeData->savePeople($request);
    }   
}
