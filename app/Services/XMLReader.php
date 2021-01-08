<?php

namespace App\Services;
use Illuminate\Support\Facades\Storage;

class XMLReader {

    protected $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    public function load()
    {
        if (!Storage::disk('local')->exists('xmls/' . $this->filename)) {
            return false;
        }
    }

    protected function isXmlFile()
    {
        $ext = pathinfo($this->filename, PATHINFO_EXTENSION);
        if (!$ext) {
            return false;
        }

        if (strtolower($ext) != 'xml') {
            return false;
        }
    }

    public function xmlAsJson()
    {
        $this->load();
        $this->isXmlFile();

        $file = Storage::disk('local')->get('xmls/' . $this->filename);

        return json_encode(simplexml_load_string($file));
    }
}
