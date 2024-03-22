<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('posts')->insert([
            'title' => 'Sample Post 1',
            'description' => 'This is the description of Sample Post 1.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('posts')->insert([
            'title' => 'Sample Post 2',
            'description' => 'This is the description of Sample Post 2.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('posts')->insert([
            'title' => 'Sample Post 3',
            'description' => 'This is the description of Sample Post 3.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Add more posts as needed
        // ...
    }

}
