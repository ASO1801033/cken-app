<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      User::create([
          'name' => '管理者',
          'email' => 'staff@example.com',
          'password' => bcrypt('staffsan'),
          'flg' => 1
      ]);

      User::create([
          'name' => '一般ユーザー1',
          'email' => 'ippan@example.com',
          'password' => bcrypt('ippan'),
          'flg' => 0
      ]);

      User::create([
          'name' => '企業ユーザー1',
          'email' => 'kigyou@example.com',
          'password' => bcrypt('kigyou'),
          'flg' => 1
      ]);
    }
}
