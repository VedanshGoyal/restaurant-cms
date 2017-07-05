<?php

use Illuminate\Database\Seeder;
use RestaurantCMS\Models\MenuSection;

// @codingStandardsIgnoreStart
class MenuSectionsSeeder extends Seeder
// @codingStandardsIgnoreEnd
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu_sections')->delete();

        for ($i = 0; $i < 7; $i++) {
            MenuSection::create([
                'name' => 'Menu Section',
                'sortId' => $i + 1,
            ]);
        }
    }
}
