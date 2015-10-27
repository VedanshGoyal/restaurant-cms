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
            'sortId' => 1,
        ]);

        MenuSection::create([
            'name' => 'Section Two',
            'sizes' => 2,
            'sortId' => 2,
            'infoTitle' => 'Toppings',
            'info' => 'Pepperoni, Olives, Peppers, Ham, Chicken, Eggplant, Sausage, Pinapple, Pepperoni, Olives, Peppers, Ham, Chicken, Eggplant, Sausage, Pinapple'
        ]);
    }
}
