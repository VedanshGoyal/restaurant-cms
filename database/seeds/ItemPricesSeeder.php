<?php

use Illuminate\Database\Seeder;
use RestaurantCMS\Models\ItemPrice;
use RestaurantCMS\Models\MenuSection;

// @codingStandardsIgnoreStart
class ItemPricesSeeder extends Seeder
// @codingStandardsIgnoreEnd
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('item_prices')->delete();

        $sections = MenuSection::all();

        $sections->each(function ($section) {
            $section->items->each(function ($item) {
                $section->sizes->each(function ($size) {
                    ItemPrice::create([
                        'itemId' => $item->id,
                        'sizeId' => $size->id,
                        'price' => '$5.00',
                    ]);
                });
            });
        });
    }
}
