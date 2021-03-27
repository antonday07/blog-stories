<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('categories')->insert([
            'title' => 'Lifestyle',
            'slug' => Str::slug('Lifestyle', '-'),
            'content' => Str::random(20),
        ]);

        DB::table('categories')->insert([
            'title' => 'Programming',
            'slug' => Str::slug('Programming', '-'),
            'content' => Str::random(20),
        ]);

        DB::table('categories')->insert([
            'title' => 'Random Talk',
            'slug' => Str::slug('Random Talk', '-'),
            'content' => Str::random(20),
        ]);
    }
}
