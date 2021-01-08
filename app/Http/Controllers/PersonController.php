<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Repositories\PersonRepository;
use Illuminate\Http\Request;
use App\Services\XMLStore;
use App\Services\XMLReader;

class PersonController extends Controller
{
    public function index(PersonRepository $model)
    {
        return $model->all();
    }

    public function store(Request $request, PersonRepository $model)
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

        $data = $this->extractData($request);

        if (!is_array($data)) {
            return response()->json('Empty or invalid xml file', 400);
        }
        
        return $model->storeMassivelly($data);
    }

    private function extractData(Request $request)
    {
        $upload = new XMLStore();
        $xmlName = $upload->run($request);

        if (!$upload) {
            return response()->json('File was not uploaded', 400);
        }

        $xmlReader = new XMLReader($xmlName);
        $xml = json_decode($xmlReader->xmlAsJson(), true);

        if (!$xml) {
            return false;
        }

        $people = false;
        if (isset($xml['person'])) {
            $people = collect($xml['person'])->map(function($item) {
                return [
                    'name' => $item['personname']
                ];
            })->toArray();
        }

        return $people;
    }
}
