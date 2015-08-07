<?php
// @codingStandardsIgnoreFile

use Illuminate\Database\Seeder;
use Restaurant\Models\SiteConfig;

class SiteConfigSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('site_config')->delete();

        SiteConfig::create(['allowReg' => 0]);
    }
}
