<?php

namespace Database\Seeders;

use App\Helpers\globalFunctionsHelper;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (globalFunctionsHelper::Permissions() as $single_permission) {
            Permission::create(['name' => $single_permission]);
        }
    }
}