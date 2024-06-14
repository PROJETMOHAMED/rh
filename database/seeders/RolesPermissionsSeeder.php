<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Roles in db
        $adminRole = Role::create(['name' => 'admin']);
        $superAdminRole = Role::create(['name' => 'super admin']);
        $userRole = Role::create(['name' => 'user']);

        // users List

        $sadmin = User::create([
            'name' => 'admin admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ])->assignRole('super admin');



        // permissions List
        $permissions = [
            // employee
            'create employee',
            'edit employee',
            'delete employee',
            'view employee',
            // Attendance
            'add attendance',
            'view attendance',
            //notes
            "create note",
            "view note",
            "edit note",
            "delete note",
            // tasks
            "create task",
            "edit task",
            "view task",
            "delete task",
            //

            'create user',
            'edit user',
            'view user',
            'delete user',
        ];

        // Create Permission in db
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Assign roles
        $sadmin->givePermissionTo(Permission::all());
    }
}
