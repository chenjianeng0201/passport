<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();
        $admins = [
            [
                'username' => 'admin1',
                'password' => bcrypt('123456'),
                'email' => 'admin1@test.com',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'username' => 'admin2',
                'password' => bcrypt('123456'),
                'email' => 'admin2@test.com',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];
        \DB::table('admins')->insert($admins);
    }
}
