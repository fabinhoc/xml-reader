<?php

namespace Tests\Unit;

use App\Shiporder;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShiporderTest extends TestCase
{
    use DatabaseTransactions;

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
