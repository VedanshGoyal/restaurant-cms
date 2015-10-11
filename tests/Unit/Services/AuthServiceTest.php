<?php

namespace Test\Unit\Services;

use Mockery as m;
use Restaurant\Services\AuthService;

class AuthServiceTest extends \TestCase
{
    public function setUp()
    {
        $this->mockUsersRepo = m::mock('Restaurant\Repositories\UsersRepo')->makePartial();
        $this->mockRolesRepo = m::mock('Restaurant\Repositories\RolesRepo')->makePartial();
        $this->mockAuth = m::mock('Tymon\JWTAuth\JWTAuth')->makePartial();
        $this->mockEvents = m::mock('Illuminate\Contracts\Events\Dispatcher');

        $this->authService = new AuthService(
            $this->mockUsersRepo,
            $this->mockRolesRepo,
            $this->mockAuth,
            $this->mockEvents
        );
    }

    public function testLoginSuccessReturnsTrue()
    {
        $this->mockAuth->shouldReceive('attempt')->once()->with(m::type('array'))->andReturn('token');

        $this->assertTrue($this->authService->login(['input']));
        $this->assertEquals('token', $this->authService->response['token']);
        $this->assertEquals('token', $this->authService->response['token']);
        $this->assertInternalType('integer', $this->authService->response['expiresIn']);
    }

    public function testLoginFailReturnsFalse()
    {
        $this->mockAuth->shouldReceive('attempt')->once()->with(m::type('array'))->andReturn(false);

        $this->assertFalse($this->authService->login(['input']));
        $this->assertInternalType('string', $this->authService->response['error']);
    }

    public function testRegisterSuccessReturnsTrue()
    {
        $mockUser = m::mock('Restaurant\Models\User')->makePartial();
        $mockCreateEvent = m::mock('Restaurant\Events\UserCreateEvent');

        $this->mockUsersRepo->shouldReceive('create')->once()->with(m::type('array'))->andReturn($mockUser);
        $this->mockEvents->shouldReceive('fire')->once()->with(m::type('Restaurant\Events\UserCreateEvent'));
        
        $this->assertTrue($this->authService->register(['input']));
        $this->assertInternalType('string', $this->authService->response['message']);
    }

    public function testRegisterFailReturnsFalse()
    {
        $this->mockUsersRepo->shouldReceive('create')->once()->with(m::type('array'))->andReturn(false);
        
        $this->assertFalse($this->authService->register(['input']));
        $this->assertInternalType('string', $this->authService->response['error']);
    }

    public function testResetPasswordSuccessReturnsTrue()
    {
        $mockUser = m::mock('Restaurant\Models\User')->makePartial();
        $mockUser->id = 1;
        $mockCreateEvent = m::mock('Restaurant\Events\PasswordResetEvent');

        $this->mockUsersRepo->shouldReceive('findByEmail')->once()->with(m::type('string'))->andReturn($mockUser);
        $this->mockUsersRepo->shouldReceive('update')->once()->with(m::type('integer'), m::type('array'));
        $this->mockEvents->shouldReceive('fire')->once()->with(m::type('Restaurant\Events\PasswordResetEvent'));

        $this->assertTrue($this->authService->resetPassword('input'));
        $this->assertInternalType('string', $this->authService->response['message']);
    }

    public function testResetPasswordFailReturnsFalse()
    {
        $this->mockUsersRepo->shouldReceive('findByEmail')->once()->with(m::type('string'))->andReturn(false);

        $this->assertFalse($this->authService->resetPassword('input'));
        $this->assertInternalType('string', $this->authService->response['error']);
    }

    public function testVerifyNewSuccessReturnsTrue()
    {
        $mockUser = m::mock('Restaurant\Models\User')->makePartial();
        $mockUser->email = 'email@input';
        $mockUser->id = 1;

        $this->mockUsersRepo->shouldReceive('findByToken')->once()->with(m::type('string'), 'create')
            ->andReturn($mockUser);
        $this->mockAuth->shouldReceive('attempt')->once()->with(m::type('array'))->andReturn('token');
        $this->mockUsersRepo->shouldReceive('update')->once()->with(m::type('integer'), m::type('array'));

        $this->assertTrue($this->authService->verifyNew('token', ['email' => 'email@input']));
        $this->assertInternalType('string', $this->authService->response['token']);
        $this->assertInternalType('integer', $this->authService->response['expiresIn']);
    }

    public function testVerifyNewEmailNotMatchReturnsFalse()
    {
        $mockUser = m::mock('Restaurant\Models\User')->makePartial();
        $mockUser->email = 'email@input';
        $mockUser->id = 1;

        $this->mockUsersRepo->shouldReceive('findByToken')->once()->with(m::type('string'), 'create')
            ->andReturn($mockUser);

        $this->assertFalse($this->authService->verifyNew('token', ['email' => 'input@email']));
        $this->assertInternalType('string', $this->authService->response['error']);
    }

    public function testVerifyNewFailReturnsFalse()
    {
        $mockUser = m::mock('Restaurant\Models\User')->makePartial();
        $mockUser->email = 'email@input';
        $mockUser->id = 1;

        $this->mockUsersRepo->shouldReceive('findByToken')->once()->with(m::type('string'), 'create')
            ->andReturn($mockUser);
        $this->mockAuth->shouldReceive('attempt')->once()->with(m::type('array'))->andReturn(false);

        $this->assertFalse($this->authService->verifyNew('token', ['email' => 'email@input']));
        $this->assertInternalType('string', $this->authService->response['error']);
    }

    public function testVerifyResetSuccessReturnsTrue()
    {
        $mockUser = m::mock('Restaurant\Models\User')->makePartial();
        $mockUser->id = 1;

        $this->mockUsersRepo->shouldReceive('findByToken')->once()->with(m::type('string'), 'reset')
            ->andReturn($mockUser);
        $this->mockUsersRepo->shouldReceive('update')->once()->with(m::type('integer'), m::type('array'));

        $this->assertTrue($this->authService->verifyReset('token', ['input']));
        $this->assertInternalType('string', $this->authService->response['message']);
    }

    public function testVerifyResetFailReturnsFalse()
    {
        $mockUser = m::mock('Restaurant\Models\User')->makePartial();

        $this->mockUsersRepo->shouldReceive('findByToken')->once()->with(m::type('string'), 'reset')
            ->andReturn(false);

        $this->assertFalse($this->authService->verifyReset('token', ['input']));
        $this->assertInternalType('string', $this->authService->response['error']);
    }
}
