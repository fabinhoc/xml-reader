<?php

namespace Tests\Unit;

use App\Shiporder;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShiporderTest extends TestCase
{
    use RefreshDatabase;

    private $table = 'shiporders';

    /**
     * Testing if not exists file
     *
     * @return void
     */
    public function testCreateShiporder()
    {
        factory(Shiporder::class)->make();
        $shiporder = factory(Shiporder::class)->create()->toArray();
        $this->assertDatabaseHas($this->table, $shiporder);
    }
}
