<?php
// @codingStandardsIgnoreFile

use Illuminate\Database\Seeder;
use Restaurant\Models\User;

class UserSeeds extends Seeder
{
    /**
     * Run the database seeds
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();

        User::create([
            'email' => 'me@nickc.io',
            'password' => 'password',
        ]);
    }
}
