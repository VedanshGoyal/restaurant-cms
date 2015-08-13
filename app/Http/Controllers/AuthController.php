<?php

namespace Restaurant\Http\Controllers;

use Restaurant\Http\Requests\ForgotPasswordRequest;
use Restaurant\Http\Requests\RegisterRequest;
use Restaurant\Http\Requests\LoginRequest;
use Restaurant\Events\UserCreateEvent;
use Restaurant\Events\PasswordResetEvent;
use Restaurant\Repositories\UsersRepo;
use Restaurant\Repositories\RolesRepo;
use Illuminate\Http\JsonResponse;
use Illuminate\Events\Dispatcher;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{
    public function __construct(
        UsersRepo $usersRepo,
        RolesRepo $rolesRepo,
        JsonResponse $response,
        JWTAuth $auth,
        Dispatcher $events
    ) {
        $this->usersRepo = $usersRepo;
        $this->rolesRepo = $rolesRepo;
        $this->response = $response;
        $this->auth = $auth;
        $this->events = $events;
    }

    /**
     * Attempt to login a user
     *
     * @return JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $whiteList = ['email', 'password'];
        $input = $request->only($whiteList);
        $token = $this->auth->attempt($input);

        if (!$token || !is_string($token)) {
            return $this->response->create([
                'error' => 'The username or password provided was not correct.',
            ]);
        }
        
        return $this->response->create(['token' => $token]);
    }

    /**
     * Register a new user account
     *
     * @return JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $whiteList = ['email', 'password'];
        $input = $request->only($whiteList);
        $user = $this->usersRepo->create($input);

        $user->generateToken('create');
        $this->events->fire(new UserCreateEvent($user));

        return $this->response->create(['ok' => true]);
    }

    /**
     * Create a reset password token and email given
     * a correct email address
     *
     * @return JsonResponse
     */
    public function resetPassword(ForgotPasswordRequest $request)
    {
        $email = $request->get('email');
        $user = $this->usersRepo->findByEmail($email);

        $user->generateToken('reset');
        $this->events->fire(new PasswordResetEvent($user));

        return $this->response->create(['ok' => true]);
    }

    /**
     * Verify a new account token
     *
     * @param string $token
     * @return JsonResponse
     */
    public function verifyNew($token)
    {
        $user = $this->usersRepo->findByToken($token, 'create');

        $user->setActive();

        return $this->response->create(['ok' => true]);
    }

    /**
     * Verify a reset password token
     *
     * @param string $token
     * @return JsonResponse
     */
    public function verifyReset($token)
    {
        $user = $this->usersRepo->findByToken($token, 'reset');

        return $this->response->create(['ok' => true]);
    }
}
