<?php

namespace Restaurant\Http\Controllers;

use Restaurant\Http\Requests\ForgotPasswordRequest;
use Restaurant\Http\Requests\RegisterRequest;
use Restaurant\Http\Requests\LoginRequest;
use Restaurant\Http\Requests\VerifyNewRequest;
use Restaurant\Http\Requests\VerifyResetRequest;
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
        $whitelist = ['email', 'password'];
        $input = $request->only($whitelist);
        $token = $this->auth->attempt($input);

        if (!$token || !is_string($token)) {
            return $this->response->create([
                'error' => 'The username or password provided was not correct.',
            ], 401);
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
        $whitelist = ['email', 'password'];
        $input = $request->only($whitelist);
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
     * Verify a new user account
     *
     * @param VerifyNewRequest $request
     * @return JsonResponse
     */
    public function verifyNew(VerifyNewRequest $request)
    {
        $whitelist = ['token', 'email', 'password'];
        $input = $request->only($whitelist);
        $token = $this->auth->attempt($input);

        if (!$token || !is_string($token)) {
            return $this->response->create([
                'error' => 'The email or password provided was not correct.',
            ], 401);
        }

        $this->auth->user()->setActive();

        return $this->response->create('Account activated successfully.');
    }

    /**
     * Verify a password reset request
     *
     * @param VerifyResetRequest $request
     * @param JsonResponse
     */
    public function verifyReset(VerifyResetRequest $request)
    {
        $whitelist = ['token', 'password'];
        $input = $request->only($whitelist);
        $user = $this->usersRepo->findByToken($input['token'], 'reset');

        $this->usersRepo->update($user->id, $input);
        $user->clearReset();

        return $this->response->create(['ok' => true]);
    }
}
