<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //userのダミーデータを2つ作成
        DB::table('users')->insert([
            [
                //admin権限を持つユーザー
                'name' => 'test1',
                'email' => 'test1@test',
                'email_verified_at' => now(),
                'user_id' => str()->uuid(),
                'is_admin' => true,
                'password' => bcrypt('test'),
                'api_token' => Str::random(60),
            ],
            [
                //admin権限を持たないユーザー
                'name' => 'test2',
                'email' => 'test2@test',
                'email_verified_at' => now(),
                'user_id' => str()->uuid(),
                'is_admin' => false,
                'password' => bcrypt('test'),
                'api_token' => Str::random(60),
            ],
        ]);
    }
}