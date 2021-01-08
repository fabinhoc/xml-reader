<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Person;

class ShiporderTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * The is invalid, is empty
     *
     * @return void
     */
    public function testUploadTest()
    {
        factory(Person::class, 3)->make();
        factory(Person::class, 3)->create()->toArray();

        Storage::fake('xml');
        $file = UploadedFile::fake()->create('test.xml');

        $request = [
            'file' => $file
        ];
        $response = $this->post('/api/upload/shiporders', $request);
        $response->assertStatus(400);
    }
}
