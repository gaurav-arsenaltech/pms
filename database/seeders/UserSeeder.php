<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('users')->insert([
//            'name' => Str::random(10),
//            'email' => Str::random(10).'@gmail.com',
//            'password' => Hash::make('123456'),
//        ]);
//        DB::table('users')->insert([
//            'first_name' => 'gaurav',
//            'last_name' => 'patel',
//            'email' => 'gauravpatel1110@gmail.com',
//            'password' => Hash::make('123456'),
//            'role_id'=>1,
//            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
//            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
//        ]);
        DB::table('users')->insert([
            'first_name' => Str::random(10),
            'last_name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('123456'),
            'role_id'=>2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
