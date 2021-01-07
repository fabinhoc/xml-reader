<?php

namespace Tests\Unit;

use App\Person;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PersonTest extends TestCase
{
    use RefreshDatabase;

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
