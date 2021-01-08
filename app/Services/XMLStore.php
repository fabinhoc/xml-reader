<?php

namespace App\Services;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class XMLStore {

    public function run(Request $request)
    {
        $name = uniqid(date('HisYmd'));
        $extension = $request->file->extension();
        $nameFile = "{$name}.{$extension}";
        $upload = $request->file->storeAs('xmls', $nameFile);

        if (!$upload) {
            return false;
        }

        return $nameFile;
    }
}
