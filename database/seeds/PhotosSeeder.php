<?php

use Illuminate\Database\Seeder;
use RestaurantCMS\Models\Photo;

// @codingStandardsIgnoreStart
class PhotosSeeder extends Seeder
// @codingStandardsIgnoreEnd
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('photos')->delete();

        $photos = [];

        for ($i = 0; $i < 5; $i++) {
            $photos[$i] = ['sort_id' => $i + 1, 'path' => 'http://lorempixel.com/700/450/'];
        }

        Photo::insert($photos);
    }
}
