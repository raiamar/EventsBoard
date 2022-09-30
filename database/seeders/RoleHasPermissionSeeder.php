<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleHasPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission_id = [1,2,3];
        foreach($permission_id as $id):
            DB::table('role_has_permissions')->insert([
                'role_id' => 1,
                'permission_id' => $id,
            ]);
        endforeach;

        DB::table('role_has_permissions')->insert([
            'role_id' => 3,
            'permission_id' => 3,
        ]);

    }
}
