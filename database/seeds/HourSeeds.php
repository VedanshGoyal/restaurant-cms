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

        $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $hourData = ['open' => '8:00 am', 'close' => '8:00 pm'];

        for ($i=0; $i<7; $i++) {
            $hourData['day'] = $days[$i];
            Hour::create($hourData);
        }
    }
}
