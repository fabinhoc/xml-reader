<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class PersonTest extends TestCase
{
    /**
     * The is invalid, is empty
     *
     * @return void
     */
    public function testUploadTest()
    {
        Storage::fake('xml');
        $file = UploadedFile::fake()->create('test.xml');

        $request = [
            'file' => $file
        ];
        $response = $this->post('/api/upload/people', $request);
        $response->assertStatus(400);
    }
}
