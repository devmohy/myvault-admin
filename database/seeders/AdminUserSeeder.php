<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assuming you have a 'Super Admin' role created
        $adminRole = Role::where('name', 'Super Admin')->first();

        if (!$adminRole) {
            // If the role doesn't exist, you should create it
        $adminRole = Role::create(['name' => 'Super Admin', 'description' => 'Super Admin','status' => 'active']);    
        }
        $platfromOwner = User::where('email', 'admin@MyVault.ng')->first();
        if (!$platfromOwner) {
            // Creating a platform owner user
            User::create([
                'email' => 'admin@MyVault.ng',
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'phone_number' => '1234567890',
                'role_id' => $adminRole->id,
                'password' => Hash::make('password'),
                'status' => 'active',
            ]);
        }
    }
}
