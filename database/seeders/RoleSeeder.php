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
        $roles = [
            ['name' => 'platform_owner', 'description' => 'Platform Owner', 'status' => 'active'],
            ['name' => 'business_owner', 'description' => 'Business Owner', 'status' => 'active'],
        ];

        foreach ($roles as $role) {
            $roleExists = Role::where('name', $role['name'])->first();
            if (!$roleExists) {
                Role::create($role);
            }
        }
    }
}
