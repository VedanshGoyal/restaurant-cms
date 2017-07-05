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
            ['info_id' => $info->id, 'phone_number' => '555-555-5555'],
            ['info_id' => $info->id, 'phone_number' => '555-555-5556'],
        ];

        foreach ($numbers as $number) {
            PhoneNumber::create($number);
        }
    }
}
