<?php

namespace Restaurant\Services;

use Restaurant\Events\UserCreateEvent;
use Restaurant\Events\PasswordResetEvent;
use Restaurant\Repositories\UsersRepo;
use Restaurant\Repositories\RolesRepo;
use Illuminate\Contracts\Events\Dispatcher;
use Restaurant\Models\User;
use Tymon\JWTAuth\JWTAuth;

class AuthService
{
    // array - response object to return
    public $response = [];

    public function __construct(
        UsersRepo $usersRepo,
        RolesRepo $rolesRepo,
        JWTAuth $auth,
        Dispatcher $events
    ) {
        $this->usersRepo = $usersRepo;
        $this->rolesRepo = $rolesRepo;
        $this->auth = $auth;
        $this->events = $events;
    }

    public function login(array $input)
    {
        $token = $this->auth->attempt($input);

        if ($token || is_string($token)) {
            $this->response['token'] = $token;
            $this->response['expiresIn'] = strtotime('+1 day');

            return true;
        }

        $this->response['error'] = 'The username or password provided was incorrect';

        return false;
    }

    public function register(array $input)
    {
        $input['createToken'] = $this->genRandomString();
        $user = $this->usersRepo->create($input);

        if ($user) {
            $this->events->fire(new UserCreateEvent($user));
            $this->response['message'] = 'Please check email for activation link';

            return true;
        }

        $this->response['error'] = 'Failed to create new account';

        return false;
    }

    public function resetPassword($email)
    {
        $user = $this->usersRepo->findByEmail($email);

        if ($user && $user instanceof User) {
            $this->usersRepo->update($user->id, ['resetToken' => $this->genRandomString()]);
            $this->events->fire(new PasswordResetEvent($user));
            $this->response['message'] = 'Please check email for reset link';

            return true;
        }

        $this->response['error'] = 'Failed to reset password';

        return false;
    }

    public function verifyNew($token, array $input)
    {
        $user = $this->usersRepo->findByToken($token, 'create');

        if (!$user || !$user instanceof User || $user->email !== $input['email']) {
            $this->response['error'] = 'Invalid email provided';

            return false;
        }

        $token = $this->auth->attempt($input);

        if ($token || is_string($token)) {
            $this->usersRepo->update($user->id, [
                'createToken' => null,
                'verified' => 1,
            ]);
            $this->response['token'] = $token;
            $this->response['expiresIn'] = strtotime('+1 day');

            return true;
        }

        $this->response['error'] = 'Account verification failed';

        return false;
    }

    public function verifyReset($token, $input)
    {
        $user = $this->usersRepo->findByToken($token, 'reset');

        if ($user && $user instanceof User) {
            $input['resetToken'] = null;
            $this->usersRepo->update($user->id, $input);
            $this->response['message'] = 'Password reset successfully';

            return true;
        }

        $this->response['error'] = 'Failed to reset password';

        return false;
    }

    private function genRandomString()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < 64; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
