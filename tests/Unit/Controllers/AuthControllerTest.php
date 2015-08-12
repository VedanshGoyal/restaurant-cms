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

    public function testRegisterReturnsSuccessMessage()
    {
        $mockInput = ['test' => 'input'];
        $mockUser = m::mock('Restaurant\Models\User')->makePartial();
        $mockRequest = $this->getMockRequest('RegisterRequest');
        $mockCreateEvent = m::mock('Restaurant\Events\UserCreateEvent', [$mockUser])->makePartial();

        $mockRequest->shouldReceive('only')->once()->with(['email', 'password'])->andReturn($mockInput);
        $this->mockRepo->shouldReceive('create')->once()->with($mockInput)->andReturn($mockUser);
        $mockUser->shouldReceive('generateToken')->once()->with('create')->andReturn(true);
        //$this->mockEvents->shouldReceive('fire')->once()->with($mockCreateEvent)->andReturn(true);
        $this->mockResponse->shouldReceive('create')->once()->with(['ok' => true])->andReturn($this->mockResponse);

        $response = $this->controller->register($mockRequest);
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    protected function getMockRequest($requestName)
    {
        $className = "Restaurant\Http\Requests\\" . $requestName;

        return m::mock($className)->makePartial();
    }
}
