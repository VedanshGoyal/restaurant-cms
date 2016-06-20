<?php
// @codingStandardsIgnoreFile

use Illuminate\Database\Seeder;
use Restaurant\Models\User;
use Illuminate\Support\Str;

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
            'email' => env('APP_ADMIN', 'admin@example.com'),
            'password' => env('APP_ENV') !== 'local' ? Str::random(64) : 'password1',
        ]);
    }
}
