<?php

namespace Pet\Database\Seeder;
use Illuminate\Database\Seeder;
use Pet\Model\Pet;

class PetSeeder extends Seeder
{
    public function run()
    {
        Pet::create([
            'name' => 'Pet 1',
            'user_id' => 1,
            'animal_id' => 1,
            'race' => 'Race 1',
            'age' => 2,
            'type' => 'Type 1',
            'kind' => 'Kind 1',
            'avatar' => 'path/to/avatar1.jpg',
            'birthDate' => '2022-01-01',
        ]);
    }
}