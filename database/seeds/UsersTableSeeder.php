<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->truncate();

        \DB::table('users')->insert(array(
            array(
                'name' => 'MyName',
                'email' => 'me@gmail.com',
                'username' => 'gbh_user',
                'password' => bcrypt('1234'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            )
        ));
    }
}
