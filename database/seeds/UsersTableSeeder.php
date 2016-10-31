<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for ($i = 0; $i <= 15; $i++ ) {
        DB::table('users')->insert([
          'name' => str_random(10),
          'email' => str_random(10).'@gmail.com',
          'password' => bcrypt('secret'),
          'address' => str_random(10),
          'username' => str_random(10),
        ]);
      }
    }
}
