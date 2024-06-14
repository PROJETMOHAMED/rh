<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create three users
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);

        // $sadmin = User::create([
        //     'name' => 'super admin',
        //     'email' => 'sadmin@sadmin.com',
        //     'password' => bcrypt('password'),
        // ]);

        // $user = User::create([
        //     'name' => 'User user',
        //     'email' => 'user@user.com',
        //     'password' => bcrypt('password'),
        // ]);

        // Assign roles to users
        // $sadmin->assignRole('super-admin');
        // $admin->assignRole('admin');
        // $user->assignRole('user');

    }
}
