<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = 'Administrator';
        $user->username = 'admin';
        $user->email = 'admin@test.com';
        $user->password = bcrypt('admin');
        $user->admin = true;
        $user->active = true;
        $user->saveOrFail();

        $user = new User;
        $user->name = 'User 1';
        $user->username = 'user1';
        $user->email = 'user1@test.com';
        $user->password = bcrypt('user1');
        $user->admin = false;
        $user->active = false;
        $user->saveOrFail();

        $user = new User;
        $user->name = 'User 2';
        $user->username = 'user2';
        $user->email = 'user2@test.com';
        $user->password = bcrypt('user2');
        $user->admin = false;
        $user->active = false;
        $user->saveOrFail();

    }
}
