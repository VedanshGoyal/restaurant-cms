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
        $this->mockEvents = m::mock('Illuminate\Events\Dispatcher')->makePartial();

        $this->controller = new AuthController(
            $this->mockRepo,
            $this->mockResponse,
            $this->mockAuth,
            $this->mockEvents
        );
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

    public function testRegisterReturnsSuccessResponse()
    {
        $mockInput = ['test' => 'input'];
        $mockUser = m::mock('Restaurant\Models\User')->makePartial();
        $mockRequest = $this->getMockRequest('RegisterRequest');
        $mockCreateEvent = m::mock('Restaurant\Events\UserCreateEvent', [$mockUser])->makePartial();

        $mockRequest->shouldReceive('only')->once()->with(['email', 'password'])->andReturn($mockInput);
        $this->mockRepo->shouldReceive('create')->once()->with($mockInput)->andReturn($mockUser);
        $mockUser->shouldReceive('generateToken')->once()->with('create');
        //$this->mockEvents->shouldReceive('fire')->once()->with($mockCreateEvent);
        $this->mockResponse->shouldReceive('create')->once()->with(['ok' => true])->andReturn($this->mockResponse);

        $response = $this->controller->register($mockRequest);
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    public function testResetPasswordReturnsSuccessResponse()
    {
        $mockEmail = 'email@example.com';
        $mockUser = m::mock('Restaurant\Models\User')->makePartial();
        $mockRequest = $this->getMockRequest('ForgotPasswordRequest');
        $mockResetEvent = m::mock('Restaurant\Events\UserResetEvent')->makePartial();

        $mockRequest->shouldReceive('get')->once()->with('email')->andReturn($mockEmail);
        $this->mockRepo->shouldReceive('findByEmail')->once()->with($mockEmail)->andReturn($mockUser);
        $mockUser->shouldReceive('generateToken')->once()->with('reset');
        //$this->mockEvents->shouldReceive('fire')->once()->with($mockResetEvent);
        $this->mockResponse->shouldReceive('create')->once()->with(['ok' => true])->andReturn($this->mockResponse);

        $response = $this->controller->resetPassword($mockRequest);
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    public function testVerifyNewFindsUserFromTokenAndSetsActive()
    {
        $mockToken = 'test-token';
        $mockUser = m::mock('Restaurant\Models\User')->makePartial();

        $this->mockRepo->shouldReceive('findByToken')->once()->with($mockToken, 'create')->andReturn($mockUser);
        $mockUser->shouldReceive('setActive')->once();
        $this->mockResponse->shouldReceive('create')->once()->with(m::type('array'))->andReturn($this->mockResponse);

        $response = $this->controller->verifyNew($mockToken);
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    public function testVerifyResetFindsUserAndReturnsResponse()
    {
        $mockToken = 'test-token';
        $mockUser = m::mock('Restaurant\Models\User')->makePartial();

        $this->mockRepo->shouldReceive('findByToken')->once()->with($mockToken, 'reset')->andReturn($mockUser);
        $this->mockResponse->shouldReceive('create')->once()->with(m::type('array'))->andReturn($this->mockResponse);

        $response = $this->controller->verifyReset($mockToken);
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    protected function getMockRequest($requestName)
    {
        $className = "Restaurant\Http\Requests\\" . $requestName;

        return m::mock($className)->makePartial();
    }
}
