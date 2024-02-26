<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();

        User::create([
            'name' => 'Demo',
            'username' => 'demo',
            'role_id' => $adminRole->id,
            'phone' => '1234567890',
            'email' => 'admin@example.com',
            'address' => 'Admin Address',
            'password' => bcrypt('picosbs'),
            'gender' => 1,
            'is_active' => true,
        ]);
    }
}
