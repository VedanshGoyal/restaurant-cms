<?php
// @codingStandardsIgnoreFilee

use Illuminate\Database\Seeder;
use Restaurant\Models\Info;

class InfoSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('info')->delete();

        Info::create([
            'name' => 'Restaurant',
            'street' => '555 street',
            'city' => 'Providence',
            'state' => 'Rhode Island',
            'zip' => '02908',
            'phone_one' => '401-555-5555',
            'phone_two' => '401-555-5556',
        ]);
    }
}
