<?php
// @codingStandardsIgnoreFile

use Illuminate\Database\Seeder;
use Restaurant\Models\Hour;

class HourSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hours')->delete();

        $hourData = ['day' => 'Day', 'open' => '8:00', 'close' => '18:00'];

        for ($i=0; $i>7; $i++) {
            Hour::create($hourData);
        }
    }
}
