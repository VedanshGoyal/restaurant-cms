<?php

namespace Tests\Unit\Controllers;

use Restaurant\Http\Controllers\AuthController;
use Mockery as m;

class AuthControllerTest extends \TestCase
{
    public function setUp()
    {
        $this->mockUsersRepo = m::mock('Restaurant\Repositories\UsersRepo')->makePartial();
        $this->mockRolesRepo = m::mock('Restaurant\Repositories\RolesRepo')->makePartial();
        $this->mockResponse = m::mock('Illuminate\Http\JsonResponse')->makePartial();
        $this->mockAuth = m::mock('Tymon\JWTAuth\JWTAuth')->makePartial();
        $this->mockEvents = m::mock('Illuminate\Events\Dispatcher')->makePartial();

        $this->controller = new AuthController(
            $this->mockUsersRepo,
            $this->mockRolesRepo,
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

    public function testLoginReturnsErrorMessageOnFailer()
    {
        $mockInput = ['test' => 'input'];
        $mockRequest = $this->getMockRequest('LoginRequest');

        $mockRequest->shouldReceive('only')->once()->with(['email', 'password'])->andReturn($mockInput);
        $this->mockAuth->shouldReceive('attempt')->once()->with($mockInput)->andReturn(false);
        $this->mockResponse->shouldReceive('create')->once()->with(m::type('array'), 400)
            ->andReturn($this->mockResponse);

        $response = $this->controller->login($mockRequest);
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    public function testRegisterReturnsSuccessResponse()
    {
        $mockInput = ['test' => 'input'];
        $mockUser = m::mock('Restaurant\Models\User')->makePartial();
        $mockRequest = $this->getMockRequest('RegisterRequest');
        $mockCreateEvent = m::mock('Restaurant\Events\UserCreateEvent')->makePartial();

        $mockRequest->shouldReceive('only')->once()->with(['email', 'password'])->andReturn($mockInput);
        $this->mockUsersRepo->shouldReceive('create')->once()->with($mockInput)->andReturn($mockUser);
        $mockUser->shouldReceive('generateToken')->once()->with('create');
        //$this->mockEvents->shouldReceive('fire')->once()->with($mockCreateEvent);
        $this->mockResponse->shouldReceive('create')->once()->with(m::type('array'))->andReturn($this->mockResponse);

        $response = $this->controller->register($mockRequest);
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    public function testRegisterReturnsErrorResponseOnCreateFail()
    {
        $mockInput = ['test' => 'input'];
        $mockRequest = $this->getMockRequest('RegisterRequest');
        $mockCreateEvent = m::mock('Restaurant\Events\UserCreateEvent')->makePartial();

        $mockRequest->shouldReceive('only')->once()->with(['email', 'password'])->andReturn($mockInput);
        $this->mockUsersRepo->shouldReceive('create')->once()->with($mockInput)->andReturn(false);
        //$this->mockEvents->shouldReceive('fire')->once()->with($mockCreateEvent);
        $this->mockResponse->shouldReceive('create')->once()
            ->with(m::type('array'), 400)->andReturn($this->mockResponse);

        $response = $this->controller->register($mockRequest);
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    public function testResetPasswordReturnsSuccessResponse()
    {
        $mockEmail = 'email@example.com';
        $mockUser = m::mock('Restaurant\Models\User')->makePartial();
        $mockRequest = $this->getMockRequest('ForgotPasswordRequest');
        $mockResetEvent = m::mock('Restaurant\Events\UserResetEvent')->makePartial();

        $mockRequest->shouldReceive('input')->once()->with('email')->andReturn($mockEmail);
        $this->mockUsersRepo->shouldReceive('findByEmail')->once()->with($mockEmail)->andReturn($mockUser);
        $mockUser->shouldReceive('generateToken')->once()->with('reset');
        //$this->mockEvents->shouldReceive('fire')->once()->with($mockResetEvent);
        $this->mockResponse->shouldReceive('create')->once()->with(m::type('array'))->andReturn($this->mockResponse);

        $response = $this->controller->resetPassword($mockRequest);
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    public function testResetPasswordReturnsErrorNoMatchingUser()
    {
        $mockEmail = 'email@example.com';
        $mockUser = m::mock('Restaurant\Models\User')->makePartial();
        $mockRequest = $this->getMockRequest('ForgotPasswordRequest');
        $mockResetEvent = m::mock('Restaurant\Events\UserResetEvent')->makePartial();

        $mockRequest->shouldReceive('input')->once()->with('email')->andReturn($mockEmail);
        $this->mockUsersRepo->shouldReceive('findByEmail')->once()->with($mockEmail)->andReturn(false);
        $this->mockResponse->shouldReceive('create')->once()->with(m::type('array'), 404)
            ->andReturn($this->mockResponse);

        $response = $this->controller->resetPassword($mockRequest);
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    public function testVerifyNewReturnsSuccess()
    {
        $mockInput = ['email' => 'email'];
        $mockToken = 'token';
        $mockUser = m::mock('Restaurant\Models\User')->makePartial();
        $mockUser->email = 'email';
        $mockRequest = $this->getMockRequest('VerifyNewRequest');

        $mockRequest->shouldReceive('input')->once()->with('token')->andReturn($mockToken);
        $mockRequest->shouldReceive('only')->once()->with(['email', 'password'])->andReturn($mockInput);
        $this->mockUsersRepo->shouldReceive('findByToken')->once()->with($mockToken, 'create')
            ->andReturn($mockUser);
        $this->mockAuth->shouldReceive('attempt')->once()->with($mockInput)->andReturn($mockToken);
        $mockUser->shouldReceive('setActive')->once()->withNoArgs();
        $this->mockResponse->shouldReceive('create')->with(m::type('array'))->andReturn($this->mockResponse);

        $response = $this->controller->verifyNew($mockRequest);
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    public function testVerifyNewReturnsErrorEmailsDontMatch()
    {
        $mockInput = ['email' => 'email'];
        $mockToken = 'token';
        $mockUser = m::mock('Restaurant\Models\User')->makePartial();
        $mockUser->email = 'email1';
        $mockRequest = $this->getMockRequest('VerifyNewRequest');

        $mockRequest->shouldReceive('input')->once()->with('token')->andReturn($mockToken);
        $mockRequest->shouldReceive('only')->once()->with(['email', 'password'])->andReturn($mockInput);
        $this->mockUsersRepo->shouldReceive('findByToken')->once()->with($mockToken, 'create')
            ->andReturn($mockUser);
        $this->mockResponse->shouldReceive('create')->with(m::type('array'), 400)->andReturn($this->mockResponse);

        $response = $this->controller->verifyNew($mockRequest);
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    public function testVerifyNewReturnsErrorFailedAuthAttempt()
    {
        $mockInput = ['email' => 'email'];
        $mockToken = 'token';
        $mockUser = m::mock('Restaurant\Models\User')->makePartial();
        $mockUser->email = 'email';
        $mockRequest = $this->getMockRequest('VerifyNewRequest');

        $mockRequest->shouldReceive('input')->once()->with('token')->andReturn($mockToken);
        $mockRequest->shouldReceive('only')->once()->with(['email', 'password'])->andReturn($mockInput);
        $this->mockUsersRepo->shouldReceive('findByToken')->once()->with($mockToken, 'create')
            ->andReturn($mockUser);
        $this->mockAuth->shouldReceive('attempt')->once()->with($mockInput)->andReturn(false);
        $this->mockResponse->shouldReceive('create')->with(m::type('array'), 400)->andReturn($this->mockResponse);

        $response = $this->controller->verifyNew($mockRequest);
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    public function testVerifyResetUpdatesPasswordReturnsSuccess()
    {
        $whitelist = ['token', 'password'];
        $mockInput = ['token' => 'input'];
        $mockUser = m::mock('Restaurant\Models\User')->makePartial();
        $mockUser->id = 1;
        $mockRequest = $this->getMockRequest('VerifyResetRequest');

        $mockRequest->shouldReceive('only')->once()->with($whitelist)->andReturn($mockInput);
        $this->mockUsersRepo->shouldReceive('findByToken')->once()
            ->with(m::type('string'), 'reset')->andReturn($mockUser);
        $this->mockUsersRepo->shouldReceive('update')->once()->with(1, m::type('array'))->andReturn(true);
        $mockUser->shouldReceive('clearReset')->once()->withNoArgs()->andReturn(true);
        $this->mockResponse->shouldReceive('create')->once()->with(m::type('array'))->andReturn($this->mockResponse);

        $response = $this->controller->verifyReset($mockRequest);
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    public function testVerifyResetReturnsErrorNoUserFound()
    {
        $whitelist = ['token', 'password'];
        $mockInput = ['token' => 'input'];
        $mockUser = m::mock('Restaurant\Models\User')->makePartial();
        $mockUser->id = 1;
        $mockRequest = $this->getMockRequest('VerifyResetRequest');

        $mockRequest->shouldReceive('only')->once()->with(['token', 'password'])->andReturn($mockInput);
        $this->mockUsersRepo->shouldReceive('findByToken')->once()->with(m::type('string'), 'reset')->andReturn(false);
        $this->mockResponse->shouldReceive('create')->once()->with(m::type('array'), 404)
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
