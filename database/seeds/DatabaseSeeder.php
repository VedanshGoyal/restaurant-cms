<?php

use Illuminate\Database\Seeder;

// @codingStandardsIgnoreStart
class DatabaseSeeder extends Seeder
// @codingStandardsIgnoreEnd
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AboutSeeder::class);
        $this->call(HoursSeeder::class);
        $this->call(InfoSeeder::class);
        $this->call(PhoneNumbersSeeder::class);
        $this->call(PhotosSeeder::class);
        $this->call(SiteConfigSeeder::class);
        $this->call(MenuSectionsSeeder::class);
        $this->call(MenuItemsSeeder::class);
        $this->call(SectionSizesSeeder::class);
        $this->call(ItemPricesSeeder::class);
    }
}
