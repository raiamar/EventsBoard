<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'id'=>1,
                'name' => 'admin',
                'guard_name' => 'web',
            ],
            [
                'id'=>2,
                'name' => 'user',
                'guard_name' => 'web'
            ],
            [
                'id'=>3,
                'name' => 'vendor',
                'guard_name' => 'web'
            ]
        ]);
    }
}
