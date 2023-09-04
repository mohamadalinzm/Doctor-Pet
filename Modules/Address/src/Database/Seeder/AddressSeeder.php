<?php

namespace Address\Database\Seeder;

use Address\Model\Address;
use Address\Model\City;
use App\Models\User;

use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    public function run()
    {
        $faker = FakerFactory::create();

        $users = User::all();
        $cities = City::all();

        // Generate some sample addresses for each user
        $users->each(function ($user) use ($faker, $cities) {
            // Generate a random number of addresses for the user
            $numAddresses = rand(1, 5);

            for ($i = 0; $i < $numAddresses; $i++) {
                Address::create([
                    'addressable_id' => $user->id,
                    'addressable_type' => User::class,
                    'user_id' => $user->id,
                    'city_id' => $cities->random()->id,
                    'type' => $faker->randomElement(['home', 'work']),
                    'area' => $faker->citySuffix,
                    'building' => $faker->buildingNumber,
                    'floor' => $faker->numberBetween(1, 20),
                    'apartment' => $faker->buildingNumber,
                    'latitude' => $faker->latitude,
                    'longitude' => $faker->longitude,
                    'address1' => $faker->streetAddress,
                    'address2' => $faker->secondaryAddress,
                    'postal_code' => $faker->postcode,
                    'is_active' => $faker->boolean(),
                    'is_default' => false,
                    'hash' => md5($faker->unique()->word),
                ]);
            }

            // If the user doesn't have any addresses, create a default one
            if ($user->addresses->count() == 0) {
                Address::create([
                    'addressable_id' => $user->id,
                    'addressable_type' => User::class,
                    'user_id' => $user->id,
                    'city_id' => $cities->random()->id,
                    'type' => 'home',
                    'area' => $faker->citySuffix,
                    'building' => $faker->buildingNumber,
                    'floor' => $faker->numberBetween(1, 20),
                    'apartment' => $faker->buildingNumber,
                    'latitude' => $faker->latitude,
                    'longitude' => $faker->longitude,
                    'address1' => $faker->streetAddress,
                    'address2' => $faker->secondaryAddress,
                    'postal_code' => $faker->postcode,
                    'is_active' => true,
                    'is_default' => true,
                    'hash' => md5($faker->unique()->word),
                ]);
            }
        });
    }
}