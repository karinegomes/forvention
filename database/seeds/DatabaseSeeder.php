<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        // Seed created for testing. Remove it when it's not necessary.
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);

    }
}
