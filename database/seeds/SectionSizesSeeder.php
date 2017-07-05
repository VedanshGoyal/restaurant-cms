<?php

use Illuminate\Database\Seeder;
use RestaurantCMS\Models\SectionSize;
use RestaurantCMS\Models\MenuSection;

// @codingStandardsIgnoreStart
class SectionSizesSeeder extends Seeder
// @codingStandardsIgnoreEnd
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('section_sizes')->delete();

        $sections = MenuSection::all();

        $sections->each(function ($section) {
            $count = rand(1, 3);

            for ($i = 0; $i < $count; $i++) {
                SectionSize::create([
                    'sectionId' => $section->id,
                    'sortId' => $i + 1,
                    'label' => 'label',
                ]);
            }
        });
    }
}
