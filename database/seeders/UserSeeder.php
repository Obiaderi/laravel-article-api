<?php

namespace Database\Seeders;

use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $this->disableForeignKeys(); // disable foreign keys
        $this->truncate('users');
        \App\Models\User::factory(10)->create();
        $this->enableForeignKeys(); // enable foreign keys
    }
}
