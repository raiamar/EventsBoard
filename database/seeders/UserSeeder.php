<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
            'id'=>1,
            'name'=>'Amar Rai',
            'email'=>'raiamar021@gmail.com',
            'password'=> bcrypt('asdfghjkl')
            ],
            [
            'id'=>2,
            'name'=>'Kitwosd IT',
            'email'=>'test@gmail.com',
            'password'=> bcrypt('asdfghjkl')
            ]
        ]);
    }
}
