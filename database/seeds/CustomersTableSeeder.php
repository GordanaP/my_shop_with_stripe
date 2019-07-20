<?php

use App\User;
use App\Customer;
use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Customer::class, 3)->create();

        User::first()->customer()->save(Customer::first());
    }
}
