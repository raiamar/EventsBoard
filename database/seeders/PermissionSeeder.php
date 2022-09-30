<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            [
                'id'=>1,
                'name'=>'manage-role',
                'guard_name'=>'web'
            ],
            [
                'id'=>2,
                'name'=>'manage-user',
                'guard_name'=>'web'
            ],
            [
                'id'=>3,
                'name'=>'manage-events',
                'guard_name'=>'web'
            ]
        ]);
    }
}
