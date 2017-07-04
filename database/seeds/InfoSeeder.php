<?php

use Illuminate\Database\Seeder;
use RestaurantCMS\Models\Info;

// @codingStandardsIgnoreStart
class InfoSeeder extends Seeder
// @codingStandardsIgnoreEnd
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('info')->delete();

        Info::create([
            'name' => 'Restaurant CMS',
            'street' => '555 Street',
            'city' => 'City',
            'state' => 'RI',
            'zip' => '12345',
        ]);
    }
}
