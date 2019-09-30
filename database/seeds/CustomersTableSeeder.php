<?php

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
        $now = \Carbon\Carbon::now();
        $customers = [
            [
                'username' => 'customer1',
                'password' => bcrypt('123456'),
                'email' => 'customer1@test.com',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'username' => 'customer2',
                'password' => bcrypt('123456'),
                'email' => 'customer2@test.com',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];
        \DB::table('customers')->insert($customers);
    }
}
