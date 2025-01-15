<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'role_id' => 1,
            'email' => 'admin@mail.com',
            'password' => Hash::make('rootadmin'),
            'status' => true,
            'deletable' => false,
        ]);
        User::create([
            'name' => 'User',
            'role_id' => 2,
            'email' => 'user@mail.com',
            'password' => Hash::make('rootuser'),
            'status' => true,
            'deletable' => false,
        ]);
        

    }
}
