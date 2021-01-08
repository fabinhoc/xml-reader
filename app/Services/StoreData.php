<?php

namespace App\Services;

use App\Repositories\ItemRepository;
use App\Repositories\PersonRepository;
use App\Repositories\PhoneRepository;
use Illuminate\Support\Facades\Validator;
use App\Repositories\ShiporderRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Services\XMLStore;
use App\Services\XMLReader;
use Hamcrest\Arrays\IsArray;

class StoreData {

    public function savePeople(Request $request)
    {
        return $this->extractPeopleData($request);
    }

    public function saveShiporder(Request $request)
    {
        return $this->extractShiporderData($request);
    }

    private function extractShiporderData(Request $request)
    {
        $upload = new XMLStore();
        $xmlName = $upload->run($request);

        if (!$upload) {
            return response()->json('File was not uploaded', 400);
        }

        $xmlReader = new XMLReader($xmlName);
        $xml = json_decode($xmlReader->xmlAsJson(), true);

        if (!$xml) {
            return response()->json('Empty or invalid file', 400);
        }

        if (isset($xml['shiporder'])) {

            foreach ($xml['shiporder'] as $shiporder) {

                $validator = Validator::make($shiporder, [
                    'orderperson' => 'required|exists:App\Person,id'
                ]);

                if ($validator->fails()) {
                    return response()->json($validator->errors()->all(), 400);
                }

                $persistShiporder = [
                    'person_id' => intval($shiporder['orderperson']),
                    'shipto_name' => $shiporder['shipto']['name'],
                    'shipto_address' => $shiporder['shipto']['address'],
                    'shipto_city' => $shiporder['shipto']['city'],
                    'shipto_country' => $shiporder['shipto']['country']
                ];

                $id = app(ShiporderRepository::class)->store($persistShiporder)->getData()->id;

                foreach ($shiporder['items'] as $item) {
                    if (isset($item['title'])) {
                        $persistItem = [
                            'shiporder_id' => $id,
                            'title' => $item['title'],
                            'note' => $item['note'],
                            'quantity' => $item['quantity'],
                            'price' => $item['price']
                        ];

                        app(ItemRepository::class)->store($persistItem);

                    } else {
                        foreach ($item as $i) {
                            $persistItem = [
                                'shiporder_id' => $id,
                                'title' => $i['title'],
                                'note' => $i['note'],
                                'quantity' => $i['quantity'],
                                'price' => $i['price']
                            ];
                            
                            app(ItemRepository::class)->store($persistItem);
                        }
                    }
                }
            }
        }

        return response()->json('success', 200);
    }

    private function extractPeopleData(Request $request)
    {
        $upload = new XMLStore();
        $xmlName = $upload->run($request);

        if (!$upload) {
            return response()->json('File was not uploaded', 400);
        }

        $xmlReader = new XMLReader($xmlName);
        $xml = json_decode($xmlReader->xmlAsJson(), true);

        if (!$xml) {
            return response()->json('Empty or invalid file', 400);
        }

        if (isset($xml['person'])) {

            foreach ($xml['person'] as $person) {
                
                $persistPerson = ['name' => $person['personname']];
                $id = app(PersonRepository::class)->store($persistPerson)->getData()->id;

                if (is_array($person['phones']['phone'])) {

                    foreach ($person['phones']['phone'] as $phone) {
                        $persistPhone = [
                            'person_id' => $id,
                            'phone' => $phone
                        ];
    
                        app(PhoneRepository::class)->store($persistPhone);
                    }
                } else {
                    $persistPhone = [
                        'person_id' => $id,
                        'phone' => $person['phones']['phone']
                    ];
                    app(PhoneRepository::class)->store($persistPhone);
                }
            }
        }

        return response()->json('success', 200);
    }
}
