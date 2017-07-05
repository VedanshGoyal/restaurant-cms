<?php

use Illuminate\Database\Seeder;
use RestaurantCMS\Models\Hour;

// @codingStandardsIgnoreStart
class HoursSeeder extends Seeder
// @codingStandardsIgnoreEnd
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hours')->delete();

        $hours = [
            [
                'day' => 'Sunday',
                'open' => '10:00 am',
                'close' => '10:00 pm',
                'is_closed' => false,
            ],
            [
                'day' => 'Monday',
                'open' => '10:00 am',
                'close' => '10:00 pm',
                'is_closed' => false,
            ],
            [
                'day' => 'Tuesday',
                'open' => '10:00 am',
                'close' => '10:00 pm',
                'is_closed' => false,
            ],
            [
                'day' => 'Wednesday',
                'open' => '10:00 am',
                'close' => '10:00 pm',
                'is_closed' => false,
            ],
            [
                'day' => 'Thursday',
                'open' => '10:00 am',
                'close' => '10:00 pm',
                'is_closed' => false,
            ],
            [
                'day' => 'Friday',
                'open' => '10:00 am',
                'close' => '10:00 pm',
                'is_closed' => false,
            ],
            [
                'day' => 'Saturday',
                'open' => '10:00 am',
                'close' => '10:00 pm',
                'is_closed' => false,
            ],
        ];

        foreach ($hours as $hour) {
            Hour::create($hour);
        }
    }
}
