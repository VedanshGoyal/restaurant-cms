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
            ], 400);
        }
        
        return $this->response->create([
            'token' => $token,
            'expiresIn' => strtotime('+1 day'),
        ]);
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

        if (!$user) {
            return $this->response->create([
                'error' => 'Failed to create new account.',
            ], 400);
        }

        $user->generateToken('create');
        $this->events->fire(new UserCreateEvent($user));

        return $this->response->create(['ok' => 'Account create. Please check email for verification link.']);
    }

    /**
     * Create a reset password token and email given
     * a correct email address
     *
     * @return JsonResponse
     */
    public function resetPassword(ForgotPasswordRequest $request)
    {
        $email = $request->input('email');
        $user = $this->usersRepo->findByEmail($email);

        if (!$user) {
            return $this->response->create(['error' => 'No matching account found.'], 404);
        }

        $user->generateToken('reset');
        $this->events->fire(new PasswordResetEvent($user));

        return $this->response->create(['ok' => 'Please check email for password reset link']);
    }
    
    /**
     * Verify a new user account
     *
     * @param VerifyNewRequest $request
     * @return JsonResponse
     */
    public function verifyNew(VerifyNewRequest $request)
    {
        $token = $request->input('verify-token');
        $input = $request->only(['email', 'password']);
        $user = $this->usersRepo->findByToken($token, 'create');

        if ($user->email !== $input['email']) {
            return $this->response->create([
                'error' => 'The email provided did not match.',
            ], 400);
        }

        $token = $this->auth->attempt($input);

        if (!$token || !is_string($token)) {
            return $this->response->create([
                'error' => 'The email or password provided was incorrect.',
            ], 400);
        }

        $user->setActive();

        return $this->response->create([
            'ok' => 'Account successfully activated',
            'token' => $token,
            'expiresIn' => strtotime('+1 day'),
        ]);
    }

    /**
     * Verify a password reset request
     *
     * @param VerifyResetRequest $request
     * @param JsonResponse
     */
    public function verifyReset(VerifyResetRequest $request)
    {
        $whitelist = ['verify-token', 'password'];
        $input = $request->only($whitelist);
        $user = $this->usersRepo->findByToken($input['verify-token'], 'reset');

        if (!$user) {
            return $this->response->create([
                'error' => 'The token provided was not valid.',
            ], 404);
        }

        $this->usersRepo->update($user->id, $input);
        $user->clearReset();

        return $this->response->create(['ok' => 'Password reset successfully.']);
    }
}
