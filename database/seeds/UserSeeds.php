<?php
// @codingStandardsIgnoreFile

use Illuminate\Database\Seeder;
use Restaurant\Models\User;
use Bican\Roles\Models\Role;
use Illuminate\Support\Str;
use Restaurant\Events\PasswordResetEvent;

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

        $user = User::create([
            'email' => env('APP_ADMIN', 'admin@example.com'),
            'password' => env('APP_ENV') !== 'local' ? Str::random(64) : 'password1',
        ]);
    }
}
