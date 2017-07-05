<?php

use Illuminate\Database\Seeder;
use RestaurantCMS\Models\MenuItem;
use RestaurantCMS\Models\MenuSection;

// @codingStandardsIgnoreStart
class MenuItemsSeeder extends Seeder
// @codingStandardsIgnoreEnd
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu_items')->delete();

        $sections = MenuSection::all();

        $sections->each(function ($section) {
            for ($i = 0; $i < 5; $i++) {
                MenuItem::create([
                    'sectionId' => $section->id,
                    'sortId' => $i + 1,
                    'name' => 'Menu Item',
                    // @codingStandardsIgnoreStart
                    'description' => ($i % 2) === 0 ? 'Phasellus non mattis erat. Pellentesque malesuada erat ut turpis fermentum sagittis. Proin non purus id tellus porta accumsan a vel enim. Pellentesque laoreet imperdiet ex, non suscipit nulla interdum et.' : null,
                    // @codingStandardsIgnoreEnd
                ]);
            }
        });
    }
}
