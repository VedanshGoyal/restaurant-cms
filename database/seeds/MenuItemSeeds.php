<?php
// @codingStandardsIgnoreFile

use Illuminate\Database\Seeder;
use Restaurant\Models\MenuSection;
use Restaurant\Models\MenuItem;

class MenuItemSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu_items')->delete();

        $sectionOne = MenuSection::find(1);
        $sectionTwo = MenuSection::find(2);

        MenuItem::create([
            'name' => 'Item One',
            'sortId' => 1,
            'priceOne' => 9.50,
            'description' => 'Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
            'section_id' => $sectionOne->id,
        ]);

        MenuItem::create([
            'name' => 'Item Two',
            'sortId' => 2,
            'priceOne' => 9.50,
            'section_id' => $sectionOne->id,
        ]);

        MenuItem::create([
            'name' => 'Item Three',
            'sortId' => 1,
            'priceOne' => 9.50,
            'priceTwo' => 15.50,
            'section_id' => $sectionTwo->id,
        ]);

        MenuItem::create([
            'name' => 'Item Four',
            'sortId' => 2,
            'priceOne' => 9.50,
            'priceTwo' => 15.50,
            'description' => 'Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
            'section_id' => $sectionTwo->id,
        ]);

    }
}
