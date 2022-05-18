<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // foreach(Post::all() as $post) {
        //     foreach(Image::all() as $image) {
        //         $post->image()->attach($image->id);
        //         continue;
        //     }
        //     $post->save();
        // }
    }
}
