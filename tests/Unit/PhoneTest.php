<?php

namespace Tests\Unit;

use App\Phone;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PhoneTest extends TestCase
{
    use DatabaseTransactions;

    private $table = 'phones';

    /**
     * Testing if not exists file
     *
     * @return void
     */
    public function testCreatePhone()
    {
        factory(Phone::class)->make();
        $phone = factory(Phone::class)->create()->toArray();
        $this->assertDatabaseHas($this->table, $phone);
    }
}
