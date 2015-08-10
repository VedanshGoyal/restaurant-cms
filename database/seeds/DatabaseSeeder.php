<?php
// @codingStandardsIgnoreFile

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(AboutSeeds::class);
        $this->call(InfoSeeds::class);
        $this->call(HourSeeds::class);
        $this->call(MenuSectionSeeds::class);
        $this->call(MenuItemSeeds::class);
        $this->call(PhotoSeeds::class);
        $this->call(SiteConfigSeeds::class);
        $this->call(RoleSeeds::class);
        $this->call(UserSeeds::class);

        Model::reguard();
    }
}
