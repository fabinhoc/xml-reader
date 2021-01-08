<?php

namespace App\Services;

use App\Repositories\ItemRepository;
use App\Repositories\PersonRepository;
use App\Repositories\PhoneRepository;
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

        $xmlReader = new XMLReader('shiporders.xml');
        $xml = json_decode($xmlReader->xmlAsJson(), true);

        if (!$xml) {
            return false;
        }

        if (isset($xml['shiporder'])) {

            foreach ($xml['shiporder'] as $shiporder) {

                $persistShiporder = [
                    'person_id' => $shiporder['orderperson'],
                    'shipto_name' => $shiporder['shipto']['name'],
                    'shipto_address' => $shiporder['shipto']['address'],
                    'shipto_city' => $shiporder['shipto']['city'],
                    'shipto_country' => $shiporder['shipto']['country']
                ];

                $id = app(ShiporderRepository::class)->store($persistShiporder)->getData()->id;

                if (is_array($shiporder['items']['items'])) {
                    foreach ($shiporder['items']['items'] as $item) {
                        $persistShiporder = [
                            'shiporder_id' => $id,
                            'title' => $item['title'],
                            'note' => $item['note'],
                            'quantity' => $item['quantity'],
                            'price' => $item['price']
                        ];
    
                        app(ItemRepository::class)->store($persistShiporder);
                    }
                } else {
                    $persistShiporder = [
                        'shiporder_id' => $id,
                        'title' => $shiporder['items']['item']['title'],
                        'note' => $shiporder['items']['item']['note'],
                        'quantity' => $shiporder['items']['item']['quantity'],
                        'price' => $shiporder['items']['item']['price']
                    ];
                    
                    app(ItemRepository::class)->store($persistShiporder);
                }
            }
        }

        return true;
    }

    private function extractPeopleData(Request $request)
    {
        $upload = new XMLStore();
        $xmlName = $upload->run($request);

        if (!$upload) {
            return response()->json('File was not uploaded', 400);
        }

        $xmlReader = new XMLReader('people.xml');
        $xml = json_decode($xmlReader->xmlAsJson(), true);

        if (!$xml) {
            return false;
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

        return true;
    }
}
