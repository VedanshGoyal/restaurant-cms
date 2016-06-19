<?php
// @codingStandardsIgnoreFile

use Illuminate\Database\Seeder;
use Restaurant\Models\MenuSection;

class MenuSectionSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu_sections')->delete();

        MenuSection::create([
            'name' => 'Section One',
            'sort_id' => 1,
        ]);

        MenuSection::create([
            'name' => 'Section Two',
            'sizes' => 2,
            'sort_id' => 2,
            'info_title' => 'Toppings',
            'info' => 'Pepperoni, Olives, Peppers, Ham, Chicken, Eggplant, Sausage, Pinapple, Pepperoni, Olives, Peppers, Ham, Chicken, Eggplant, Sausage, Pinapple'
        ]);
    }
}
