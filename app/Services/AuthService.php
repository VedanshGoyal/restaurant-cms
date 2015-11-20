<?php

namespace Restaurant\Services;

use Restaurant\Events\UserCreateEvent;
use Restaurant\Events\PasswordResetEvent;
use Restaurant\Repositories\UserRepo;
use Restaurant\Repositories\RoleRepo;
use Illuminate\Contracts\Events\Dispatcher;
use Restaurant\Models\User;
use Tymon\JWTAuth\JWTAuth;

class AuthService
{
    // @var string - auth token
    protected $token;

    /**
     * Initialize new instance
     *
     * @param UserRepo $userRepo
     * @param RoleRepo $roleRepo
     * @param JWTAuth $auth
     * @param Dispatcher $dispatcher
     */
    public function __construct(
        UserRepo $userRepo,
        RoleRepo $roleRepo,
        JWTAuth $auth,
        Dispatcher $events
    ) {
        $this->userRepo = $userRepo;
        $this->roleRepo = $roleRepo;
        $this->auth = $auth;
        $this->events = $events;
    }

    /**
     * Attempt login given email and password
     *
     * @param array $input
     * @return boolean
     */
    public function login(array $input)
    {
        $token = $this->auth->attempt($input);

        if ($token || is_string($token)) {
            $this->token = $token;

            return true;
        }

        return false;
    }

    /**
     * Attempt to register new user given email and password
     *
     * @param array $input
     * @return boolean
     */
    public function register(array $input)
    {
        $input['createToken'] = $this->genRandomString();
        $user = $this->userRepo->create($input);

        if ($user && $user instanceof User) {
            $this->events->fire(new UserCreateEvent($user));

            return true;
        }

        return false;
    }

    /**
     * Trigger a reset password event given email
     *
     * @param string $email
     * @return boolean
     */
    public function resetPassword($email)
    {
        $user = $this->userRepo->findByEmail($email);

        if ($user && $user instanceof User) {
            $user->resetToken = $this->genRandomString();
            $this->userRepo->update($user->id, $user->toArray());
            $this->events->fire(new PasswordResetEvent($user));

            return true;
        }

        return false;
    }

    /**
     * Verify and authenticate user given verify token, email, and password
     *
     * @param string $token
     * @param array $input
     * @return boolean
     */
    public function verifyNew($token, array $input)
    {
        $user = $this->userRepo->findByToken($token, 'create');

        if (!$user || !$user instanceof User || $user->email !== $input['email']) {
            return false;
        }

        $token = $this->auth->attempt($input);

        if ($token || is_string($token)) {
            $this->userRepo->update($user->id, ['createToken' => null, 'verified' => 1]);
            $this->token = $token;

            return true;
        }

        return false;
    }

    /**
     * Verify and update user password given verify token and password
     *
     * @param string $token
     * @param array $input
     * @return boolean
     */
    public function verifyReset($token, $input)
    {
        $user = $this->userRepo->findByToken($token, 'reset');

        if ($user && $user instanceof User) {
            $input['resetToken'] = null;
            $this->userRepo->update($user->id, $input);

            return true;
        }

        return false;
    }

    /**
     * Get the protected token value
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Generate a random string
     *
     * @return string
     */
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
