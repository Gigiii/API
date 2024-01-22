<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("user_roles")->insert([
            'name' => 'Student',
        ]);

        DB::table("user_roles")->insert([
            'name' => 'Professor',
        ]);
    }
}
