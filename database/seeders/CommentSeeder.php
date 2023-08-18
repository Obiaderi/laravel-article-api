<?php

namespace Database\Seeders;

use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->disableForeignKeys(); // disable foreign keys

        $this->truncate('comments');

        \App\Models\Comment::factory(3)
        // ->forPost() // create 2 comments for each post created
        ->create();

        $this->enableForeignKeys(); // enable foreign keys
    }
}
