<?php

namespace Database\Seeders;

use App\Models\Post;
use Database\Factories\Helpers\FactoryHelper;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->disableForeignKeys(); // disable foreign keys

        $this->truncate('posts');

        $posts = Post::factory(3)
        // ->hasComments(2) // create 2 comments for each post created
        ->untitled()
        ->create();

        // seeding many to many relationship
        $posts->each(function(Post $post){
            $post->users()->sync([FactoryHelper::getRandomModelId(User::class)]);
        });

        $this->enableForeignKeys(); // enable foreign keys

    }
}
