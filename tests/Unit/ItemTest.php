<?php

namespace Tests\Unit;

use App\Item;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemTest extends TestCase
{
    use RefreshDatabase;

    private $table = 'items';

    /**
     * Testing if not exists file
     *
     * @return void
     */
    public function testCreateItem()
    {
        factory(Item::class)->make();
        $item = factory(Item::class)->create()->toArray();
        $this->assertDatabaseHas($this->table, $item);
    }
}
