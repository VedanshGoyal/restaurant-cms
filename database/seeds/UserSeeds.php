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

        $admin = Role::find(1);
        $owner = Role::find(2);
        $user = User::create([
            'email' => env('APP_ADMIN', 'admin@example.com'),
            'password' => env('APP_ENV') !== 'local' ? Str::random(64) : 'password1',
        ]);

        $user->attachRole($admin);
        $user->attachRole($owner);

        if (env('APP_ENV') !== 'local') {
            $user->update([
                'verified' => 1,
                'resetToken' => Str::random(64),
            ]);
            event(new PasswordResetEvent($user));
        }
    }
}
