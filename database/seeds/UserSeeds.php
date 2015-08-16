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
            'email' => 'me@nickc.io',
            'password' => Str::random(64),
        ]);

        $user->attachRole($admin);
        $user->attachRole($owner);
        $user->setActive();
        $user->generateToken('reset');
        event(new PasswordResetEvent($user));
    }
}
