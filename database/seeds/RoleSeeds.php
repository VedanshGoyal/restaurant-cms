<?php
// @codingStandardsIgnoreFile

use Illuminate\Database\Seeder;
use Bican\Roles\Models\Role;

class RoleSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'level' => 1,
        ]);

        Role::create([
            'name' => 'Owner',
            'slug' => 'owner',
            'level' => 2,
        ]);
    }
}
