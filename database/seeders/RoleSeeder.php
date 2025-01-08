<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Defines array of roles
        $roles = [
            ['name' => 'User'],
            ['name' => 'Admin'],
            ['name' => 'Super Admin'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
