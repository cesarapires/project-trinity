<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $addressSeeder = new AddressSeeder();
        $customerSeeder = new CustomerSeeder();
        $orderSeeder = new OrderSeeder();

         \App\Models\User::factory(10)->create();
        $customerSeeder->run();
        $addressSeeder->run();
        $orderSeeder->run();
    }
}
