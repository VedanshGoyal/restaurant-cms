<?php

namespace Restaurant\Http\Controllers;

use Tymon\JWTAuth\JWTAuth;
use Illuminate\Http\JsonResponse;
use Restaurant\Repositories\AuthRepo;
use Restaurant\Http\Requests\LoginRequest;
use Restaurant\Http\Requests\RegisterRequest;
use Restaurant\Http\Requests\ForgotPasswordRequest;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function __construct(
        AuthRepo $repository,
        JsonResponse $response,
        JWTAuth $auth
    ) {
        $this->repository = $repository;
        $this->response = $response;
        $this->auth = $auth;
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
        $response;

        try {
            $token = $this->auth->attempt($input);

            if (!$token || empty($token)) {
                return $this->response->create([
                    'error' => 'The username or password provided was not correct.',
                ]);
            }
            
            return $this->response->create(['token' => $token]);
        } catch (JWTException $e) {
            return $this->response->create(['error' => 'Failed to generate token.']);
        }
    }

    /**
     * Register a new user account
     *
     * @return JsonResponse
     */
    public function register(RegisterRequest $request)
    {
    }

    /**
     * Create a reset password token and email given
     * a correct email address
     *
     * @return JsonResponse
     */
    public function resetPassword(ForgotPasswordRequest $request)
    {
    }

    /**
     * Verify a new account token
     *
     * @param string $token
     * @return JsonResponse
     */
    public function verifyNew($token)
    {
    }

    /**
     * Verify a reset password token
     *
     * @param string $token
     * @return JsonResponse
     */
    public function verifyReset($token)
    {
    }
}
