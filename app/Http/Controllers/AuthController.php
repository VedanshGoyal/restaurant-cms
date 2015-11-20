<?php

namespace Restaurant\Http\Controllers;

use Restaurant\Http\Requests\ResetPasswordRequest;
use Restaurant\Http\Requests\RegisterRequest;
use Restaurant\Http\Requests\LoginRequest;
use Restaurant\Http\Requests\VerifyNewRequest;
use Restaurant\Http\Requests\VerifyResetRequest;
use Restaurant\Services\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    // @var Restaurant\Services\AuthService
    protected $authService;

    // @var Illuminate\Http\JsonResponse
    protected $response;

    /**
     * Initialize new instance
     *
     * @param Restaurant\Services\AuthService $authService
     * @param Illuminate\Http\JsonResponse $response
     */
    public function __construct(AuthService $authService, JsonResponse $response)
    {
        $this->authService = $authService;
        $this->response = $response;
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

        if ($this->authService->login($input)) {
            return $this->response->create($this->authService->response);
        }
        
        return $this->response->create($this->authService->response, 400);
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

        if ($this->authService->register($input)) {
            return $this->response->create($this->authService->response);
        }

        return $this->response->create($this->authService->response, 400);
    }

    /**
     * Create a reset password token and email given
     * a correct email address
     *
     * @return JsonResponse
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        $input = $request->only('email');

        if ($this->authService->resetPassword($input)) {
            return $this->response->create($this->authService->response);
        }

        return $this->response->create($this->authService->response, 400);
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

        if ($this->authService->verifyNew($token, $input)) {
            return $this->response->create($this->authService->response);
        }

        return $this->response->create($this->authService->response, 400);
    }

    /**
     * Verify a password reset request
     *
     * @param VerifyResetRequest $request
     * @param JsonResponse
     */
    public function verifyReset(VerifyResetRequest $request)
    {
        $token = $request->input('verify-token');
        $input = $request->only('password');

        if ($this->authService->verifyReset($token, $input)) {
            return $this->response->create($this->authService->response);
        }

        return $this->response->create($this->authService->response, 400);
    }
}
