<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employees')->insert([
            'emp_id'            => '2024052351',
            'fname'             => 'Jay-ar',
            'mname'             => 'Ebrado',
            'lname'             => 'Cristobal',
            'email'             => 'developer@gmail.com',
        ]);
    }
}
