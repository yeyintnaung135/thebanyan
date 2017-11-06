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
       $vader = DB::table('users')->insert([
                'username'   => 'Administrator',
                'email'      => 'admin@gmail.com',
                'password'   => Hash::make('admin123'),
                'role'   => 'SuperAdmin',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ]);
    }
}
