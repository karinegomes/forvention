<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Jessica K. Martin',
            'email' => 'jessicakmartin@gmail.com',
            'phone' => '330-898-2423',
            'password' => bcrypt('secret'),
        ]);

        DB::table('users')->insert([
            'name' => 'John L. Bray',
            'email' => 'johnlbray@gmail.com',
            'phone' => '740-541-1953',
            'password' => bcrypt('secret'),
        ]);

        DB::table('users')->insert([
            'name' => 'Lisa W. Simpson',
            'email' => 'lisawsimpson@gmail.com',
            'phone' => '786-469-4983',
            'password' => bcrypt('secret'),
        ]);
    }
}
