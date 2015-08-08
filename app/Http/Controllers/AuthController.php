<?php

namespace Restaurant\Http\Controllers;

use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(JsonResponse $response)
    {
        $this->response = $response;
    }

    /**
     * Attempt to login a user
     *
     * @return JsonResponse
     */
    public function login()
    {

    }

    /**
     * Register a new user account
     *
     * @return JsonResponse
     */
    public function register()
    {

    }

    /**
     * Create a reset password token and email given
     * a correct email address
     *
     * @return JsonResponse
     */
    public function resetPassword()
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
