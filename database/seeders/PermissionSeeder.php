<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $features = Feature::all();

        $permissions = ['create', 'read', 'update', 'delete'];

        foreach ($features as $feature) {
            foreach ($permissions as $permission) {
                Permission::create([
                    'name' => $permission,
                    'feature_id' => $feature->id,
                ]);
            }
        }
    }
}
