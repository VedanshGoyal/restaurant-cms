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

        Photo::create(['path' => 'images/test/test-one.png']);
        Photo::create(['path' => 'images/test/test-two.png']);
    }
}
