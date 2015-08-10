<?php

namespace Tests\Unit\Controllers;

use Restaurant\Http\Controllers\AuthController;
use Mockery as m;
use JWTAuth;

class AuthControllerTest extends \TestCase
{
    public function setUp()
    {
        $this->mockRepo = m::mock('Restaurant\Repositories\AuthRepo')->makePartial();
        $this->mockResponse = m::mock('Illuminate\Http\JsonResponse')->makePartial();
        $this->mockAuth = m::mock('Tymon\JWTAuth\JWTAuth')->makePartial();

        $this->controller = new AuthController($this->mockRepo, $this->mockResponse, $this->mockAuth);
    }

    public function tearDown()
    {
        m::close();
    }

    public function testLoginReturnsTokenOnSuccess()
    {
        $mockInput = ['test' => 'input'];
        $mockToken = 'mockToken';
        $mockRequest = $this->getMockRequest('LoginRequest');
        $mockRequest->shouldReceive('only')->once()->with(['email', 'password'])->andReturn($mockInput);
        $this->mockAuth->shouldReceive('attempt')->once()->with($mockInput)->andReturn($mockToken);
        $this->mockResponse->shouldReceive('create')->once()
            ->with(['token' => $mockToken])->andReturn($this->mockResponse);

        $response = $this->controller->login($mockRequest);
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    public function testLoginReturnsErrorWithInvalidInput()
    {
        $mockInput = ['test' => 'input'];
        $mockToken = 'mockToken';
        $mockRequest = $this->getMockRequest('LoginRequest');
        $mockRequest->shouldReceive('only')->once()->with(['email', 'password'])->andReturn($mockInput);
        $this->mockAuth->shouldReceive('attempt')->once()->with($mockInput)->andReturn(false);
        $this->mockResponse->shouldReceive('create')->once()
            ->with(['error' => 'The username or password provided was not correct.'])->andReturn($this->mockResponse);

        $response = $this->controller->login($mockRequest);
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    public function testLoginReturnsErrorWhenJWTAuthFails()
    {
        $mockInput = ['test' => 'input'];
        $mockToken = 'mockToken';
        $mockRequest = $this->getMockRequest('LoginRequest');
        $mockRequest->shouldReceive('only')->once()->with(['email', 'password'])->andReturn($mockInput);
        $this->mockAuth->shouldReceive('attempt')->once()
            ->with($mockInput)->andThrow('Tymon\JWTAuth\Exceptions\JWTException');
        $this->mockResponse->shouldReceive('create')->once()
            ->with(['error' => 'Failed to generate token.'])->andReturn($this->mockResponse);

        $response = $this->controller->login($mockRequest);
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    protected function getMockRequest($requestName)
    {
        $className = "Restaurant\Http\Requests\\" . $requestName;

        return m::mock($className)->makePartial();
    }
}
