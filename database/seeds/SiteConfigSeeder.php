<?php

use Illuminate\Database\Seeder;
use RestaurantCMS\Models\SiteConfig;

// @codingStandardsIgnoreStart
class SiteConfigSeeder extends Seeder
// @codingStandardsIgnoreEnd
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('site_config')->delete();

        SiteConfig::create(['allowReg' => true]);
    }
}
