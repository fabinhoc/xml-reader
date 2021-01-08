<?php

namespace Tests\Unit;

use App\Person;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PersonTest extends TestCase
{
    use DatabaseTransactions;

    private $table = 'people';

    /**
     * Testing if not exists file
     *
     * @return void
     */
    public function testCreatePerson()
    {
        factory(Person::class)->make();
        $person = factory(Person::class)->create()->toArray();
        $this->assertDatabaseHas($this->table, $person);
    }
}
