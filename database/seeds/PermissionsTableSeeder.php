<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'name' => 'Manage users',
            'constant_name' => 'MANAGE_USERS',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('permissions')->insert([
            'name' => 'Manage events',
            'constant_name' => 'MANAGE_EVENTS',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('permissions')->insert([
            'name' => 'Manage event admins',
            'constant_name' => 'MANAGE_EVENT_ADMINS',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('permissions')->insert([
            'name' => 'Manage visitors in events',
            'constant_name' => 'MANAGE_VISITORS_EVENTS',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('permissions')->insert([
            'name' => 'Manage event info',
            'constant_name' => 'MANAGE_EVENT_INFO',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('permissions')->insert([
            'name' => 'Manage users in event',
            'constant_name' => 'MANAGE_USERS_EVENT',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('permissions')->insert([
            'name' => 'Manage companies',
            'constant_name' => 'MANAGE_COMPANIES',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('permissions')->insert([
            'name' => 'Manage presentors in event',
            'constant_name' => 'MANAGE_PRESENTORS_EVENT',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('permissions')->insert([
            'name' => 'View events',
            'constant_name' => 'VIEW_EVENTS',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('permissions')->insert([
            'name' => 'View companies',
            'constant_name' => 'VIEW_COMPANIES',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('permissions')->insert([
            'name' => 'View company',
            'constant_name' => 'VIEW_COMPANY',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('permissions')->insert([
            'name' => 'View event',
            'constant_name' => 'VIEW_EVENT',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}
