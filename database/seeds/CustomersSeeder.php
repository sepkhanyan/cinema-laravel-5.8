<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userList = [
            'Adriana Uria',
            'Albert Einstein',
            'Anna Behrensmeyer',
            'Blaise Pascal',
            'Caroline Herschel',
            'Cecilia Payne-Gaposchkin'
        ];

        foreach ($userList as $fullName) {
            $name = str_replace(' ', '.', $fullName);

            DB::table('users')->insert([
                'name' => $fullName,
                'email' => strtolower($name) . '@gmail.com',
                'role' => 0,
                'password' => Hash::make('root'),
            ]);
        }
    }
}
