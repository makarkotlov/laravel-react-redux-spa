<?php

use Illuminate\Database\Seeder;

class CreateUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@admin.com',
            'phone_number' => '8888888888',
            'department_id' => '1',
            'is_admin' => '1',
            'password' => bcrypt('admin'),
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
