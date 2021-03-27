<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            'title' => 'Laravel',
            'slug' => Str::slug('Laravel', '-'),
            'content' => Str::random(20),
        ]);

        DB::table('tags')->insert([
            'title' => 'Javascript',
            'slug' => Str::slug('Javascript', '-'),
            'content' => Str::random(20),
        ]);

        DB::table('tags')->insert([
            'title' => 'ReactJs',
            'slug' => Str::slug('ReactJs', '-'),
            'content' => Str::random(20),
        ]);

        DB::table('tags')->insert([
            'title' => 'VueJs',
            'slug' => Str::slug('VueJs', '-'),
            'content' => Str::random(20),
        ]);
    }
}
