<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\XMLReader;

class XMLReaderTest extends TestCase
{
    /**
     * Testing if not exists file
     *
     * @return void
     */
    public function testReadxml()
    {
        $xml = new XMLReader('people.xml');
        $data = $xml->xmlAsJson();
        $this->assertTrue(true);
    }
}
