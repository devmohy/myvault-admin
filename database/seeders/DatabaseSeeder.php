<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Bank;
use App\Models\User;
use App\Models\State;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $seeders = [
            PermissionSeeder::class,
        ];
        $platformOwner = User::where('email', 'admin@MyVault.ng')->first();
        if (!$platformOwner) {
            $seeders[] = AdminUserSeeder::class;
        }
        $this->call($seeders);
    }
}
