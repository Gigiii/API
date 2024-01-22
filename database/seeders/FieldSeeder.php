<?php

namespace Database\Seeders;

use App\Models\Field;
use Database\Factories\FieldFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Field::factory()->count(10)->create();
        
    }
}
