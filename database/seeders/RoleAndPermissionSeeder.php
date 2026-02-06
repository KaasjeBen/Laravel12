<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        $projectPermissions = ['index project', 'create project', 'show project', 'edit project', 'delete project'];
        $taskPermissions = ['index task', 'create task', 'show task', 'edit task', 'delete task'];

        foreach (array_merge($projectPermissions, $taskPermissions) as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $student = Role::firstOrCreate(['name' => 'student', 'guard_name' => 'web']);
        $teacher = Role::firstOrCreate(['name' => 'teacher', 'guard_name' => 'web']);
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);

        $student->syncPermissions([
            'index project',
            'create project',
            'show project',
            'edit project',
            // Task permissions
            'index task',
            'create task',
            'show task',
            'edit task',
            'delete task',
        ]);

        $teacher->syncPermissions(array_merge($projectPermissions, $taskPermissions));
        $admin->syncPermissions(array_merge($projectPermissions, $taskPermissions));
    }
}
