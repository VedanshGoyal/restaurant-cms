<?php

use Illuminate\Database\Seeder;
use RestaurantCMS\Models\PhoneNumber;
use RestaurantCMS\Models\Info;

// @codingStandardsIgnoreStart
class PhoneNumbersSeeder extends Seeder
// @codingStandardsIgnoreEnd
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('phone_numbers')->delete();

        $info = Info::first();
        $numbers = [
            ['infoId' => $info->id, 'phone_number' => '555-555-5555'],
            ['infoId' => $info->id, 'phone_number' => '555-555-5556'],
        ];

        foreach ($numbers as $number) {
            PhoneNumber::create($number);
        }
    }
}
