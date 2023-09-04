<?php

namespace Animal\Database\Seeder;
use Illuminate\Database\Seeder;
use Animal\Model\Animal;

class AnimalSeeder extends Seeder
{
    public function run()
    {
        Animal::create([
            'name' => 'Animal 1',
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