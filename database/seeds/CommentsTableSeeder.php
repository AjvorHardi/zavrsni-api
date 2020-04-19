<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Gradebook::all()->each(function(App\Gradebook $gradebook) {
            $gradebook->comment()->saveMany(factory(App\Comment::class, 4)->make());
        });
    }
}
