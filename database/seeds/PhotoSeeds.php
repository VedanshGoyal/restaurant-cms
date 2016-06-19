<?php
// @codingStandardsIgnoreFile

use Illuminate\Database\Seeder;
use Restaurant\Models\Photo;

class PhotoSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('photos')->delete();

        for ($i = 1; $i <= 4; $i++) {
            Photo::create(['path' => "/images/uploads/food-{$i}.jpg"]);
        }
    }
}
