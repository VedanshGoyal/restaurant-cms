<?php

namespace Tests\Unit\Controllers;

use Restaurant\Http\Controllers\AuthController;
use Mockery as m;

class AuthControllerTest extends \TestCase
{
    public function setUp()
    {
        $this->mockAuthService = m::mock('Restaurant\Services\AuthService')->makePartial();
        $this->mockResponse = m::mock('Illuminate\Http\JsonResponse')->makePartial();
        $this->mockAuthService->response = [];

        $this->controller = new AuthController($this->mockAuthService, $this->mockResponse);
    }

    public function tearDown()
    {
        m::close();
    }

    public function testLoginSuccess()
    {
        $mockRequest = $this->getMockRequest('LoginRequest');

        $mockRequest->shouldReceive('only')->once()->with(['email', 'password'])->andReturn(['input']);
        $this->mockAuthService->shouldReceive('login')->once()->with(['input'])->andReturn(true);
        $this->mockResponse->shouldReceive('create')->once()->with(m::type('array'))->andReturn($this->mockResponse);

        $response = $this->controller->login($mockRequest);
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    public function testLoginFail()
    {
        $mockRequest = $this->getMockRequest('LoginRequest');

        $mockRequest->shouldReceive('only')->once()->with(['email', 'password'])->andReturn(['input']);
        $this->mockAuthService->shouldReceive('login')->once()->with(['input'])->andReturn(false);
        $this->mockResponse->shouldReceive('create')->once()->with(m::type('array'), 400)
            ->andReturn($this->mockResponse);

        $response = $this->controller->login($mockRequest);
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    public function testRegisterSuccess()
    {
        $mockRequest = $this->getMockRequest('RegisterRequest');

        $mockRequest->shouldReceive('only')->once()->with(['email', 'password'])->andReturn(['input']);
        $this->mockAuthService->shouldReceive('register')->once()->with(m::type('array'))->andReturn(true);
        $this->mockResponse->shouldReceive('create')->once()->with(m::type('array'))->andReturn($this->mockResponse);

        $response = $this->controller->register($mockRequest);
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    public function testRegisterFail()
    {
        $mockRequest = $this->getMockRequest('RegisterRequest');

        $mockRequest->shouldReceive('only')->once()->with(['email', 'password'])->andReturn(['input']);
        $this->mockAuthService->shouldReceive('register')->once()->with(m::type('array'))->andReturn(false);
        $this->mockResponse->shouldReceive('create')->once()->with(m::type('array'), 400)
            ->andReturn($this->mockResponse);

        $response = $this->controller->register($mockRequest);
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    public function testResetPasswordSuccess()
    {
        $mockRequest = $this->getMockRequest('ResetPasswordRequest');

        $mockRequest->shouldReceive('only')->once()->with('email')->andReturn(['input']);
        $this->mockAuthService->shouldReceive('resetPassword')->once()->with(m::type('array'))->andReturn(true);
        $this->mockResponse->shouldReceive('create')->once()->with(m::type('array'))->andReturn($this->mockResponse);

        $response = $this->controller->resetPassword($mockRequest);
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    public function testResetPasswordFail()
    {
        $mockRequest = $this->getMockRequest('ResetPasswordRequest');

        $mockRequest->shouldReceive('only')->once()->with('email')->andReturn(['input']);
        $this->mockAuthService->shouldReceive('resetPassword')->once()->with(m::type('array'))->andReturn(false);
        $this->mockResponse->shouldReceive('create')->once()->with(m::type('array'), 400)
            ->andReturn($this->mockResponse);

        $response = $this->controller->resetPassword($mockRequest);
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    public function testVerifyNewSuccess()
    {
        $mockRequest = $this->getMockRequest('VerifyNewRequest');

        $mockRequest->shouldReceive('input')->once()->with('verify_token')->andReturn('token');
        $mockRequest->shouldReceive('only')->once()->with(['email', 'password'])->andReturn(['input']);
        $this->mockAuthService->shouldReceive('verifyNew')->once()->with(m::type('string'), m::type('array'))
            ->andReturn(true);
        $this->mockResponse->shouldReceive('create')->once()->with(m::type('array'))->andReturn($this->mockResponse);

        $response = $this->controller->verifyNew($mockRequest);
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    public function testVerifyNewFail()
    {
        $mockRequest = $this->getMockRequest('VerifyNewRequest');

        $mockRequest->shouldReceive('input')->once()->with('verify_token')->andReturn('token');
        $mockRequest->shouldReceive('only')->once()->with(['email', 'password'])->andReturn(['input']);
        $this->mockAuthService->shouldReceive('verifyNew')->once()->with(m::type('string'), m::type('array'))
            ->andReturn(false);
        $this->mockResponse->shouldReceive('create')->once()->with(m::type('array'), 400)
            ->andReturn($this->mockResponse);

        $response = $this->controller->verifyNew($mockRequest);
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    public function testVerifyResetSuccess()
    {
        $mockRequest = $this->getMockRequest('VerifyResetRequest');

        $mockRequest->shouldReceive('input')->once()->with('verify_token')->andReturn('token');
        $mockRequest->shouldReceive('only')->once()->with('password')->andReturn(['input']);
        $this->mockAuthService->shouldReceive('verifyReset')->once()->with(m::type('string'), m::type('array'))
            ->andReturn(true);
        $this->mockResponse->shouldReceive('create')->once()->with(m::type('array'))->andReturn($this->mockResponse);

        $response = $this->controller->verifyReset($mockRequest);
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    public function testVerifyResetFail()
    {
        $mockRequest = $this->getMockRequest('VerifyResetRequest');

        $mockRequest->shouldReceive('input')->once()->with('verify_token')->andReturn('token');
        $mockRequest->shouldReceive('only')->once()->with('password')->andReturn(['input']);
        $this->mockAuthService->shouldReceive('verifyReset')->once()->with(m::type('string'), m::type('array'))
            ->andReturn(false);
        $this->mockResponse->shouldReceive('create')->once()->with(m::type('array'), 400)
            ->andReturn($this->mockResponse);

        $response = $this->controller->verifyReset($mockRequest);
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    protected function getMockRequest($requestName)
    {
        $className = "Restaurant\Http\Requests\\" . $requestName;

        return m::mock($className)->makePartial();
    }
}
