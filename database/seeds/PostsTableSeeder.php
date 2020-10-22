<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 20; $i++){
            $newPost = new Post();
            $newPost->user_id = $faker->numberBetween(1, 11);
            $newPost->titolo = $faker->text(50);
            $newPost->articolo = $faker->text(1000) ;
            $newPost->slug = Str::slug($newPost->titolo, '-');
            $newPost->save();
        }
    }
}
