<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('des_types')->insert([
            'designation'            => 'Chief Executive Officer',
            'designation'            => 'Chief Operating Officer',
            'designation'            => 'Human Resources',
            'designation'            => 'Web Developer',
            'designation'            => 'Web Designer',
            ]);
    }
}
