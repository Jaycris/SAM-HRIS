<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'emp_id'            => '2024052351',
            'email'             => 'landerson@bookmarcalliance.com',
            'password'          => Hash::make('password'),
            'user_created'      => '2024/06/06',
            'user_status'       => 'Active',
        ]);
    }
}
