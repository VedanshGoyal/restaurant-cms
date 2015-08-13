<?php

namespace Tests\Unit\Repositories;

use Mockery as m;
use Restaurant\Repositories\AuthRepo;

class AuthRepoTest extends \TestCase
{
    public function setUp()
    {
        $this->repoModel = m::mock('Restaurant\Models\User')->makePartial();
        $this->repoRole = m::mock('Bican\Roles\Models\Role')->makePartial();

        $this->mockUser = m::mock('Restaurant\Models\User')->makePartial();
        $this->mockRole = m::mock('Bican\Roles\Models\Role')->makePartial();
        $this->mockCollection = $this->getMockCollection();

        $this->repo = new AuthRepo($this->repoModel, $this->repoRole);
    }

    public function tearDown()
    {
        m::close();
    }

    public function testAttachRoleAddsRoleToAndReturnsUserModel()
    {
        $userId = 1;
        $roleName = 'role';

        $this->repoModel->shouldReceive('findOrFail')->once()->with($userId)->andReturn($this->mockUser);
        $this->repoRole->shouldReceive('where')->once()
            ->with('slug', $roleName)->andReturn($this->mockCollection);
        $this->mockCollection->shouldReceive('first')->once()->andReturn($this->mockRole);
        $this->mockUser->shouldReceive('attachRole')->once()->with($this->mockRole)->andReturn(true);

        $user = $this->repo->addRole($userId, $roleName);
        $this->assertInstanceOf('Restaurant\Models\User', $user);
    }
    
    /**
     * @expectedException Restaurant\Exceptions\RepositoryException
     */
    public function testAttachRoleThrowsExceptionIfNoValidRole()
    {
        $userId = 1;
        $roleName = 'role';

        $this->repoModel->shouldReceive('findOrFail')->once()->with($userId)->andReturn($this->mockUser);
        $this->repoRole->shouldReceive('where')->once()
            ->with('slug', $roleName)->andReturn($this->mockCollection);
        $this->mockCollection->shouldReceive('first')->once()->andReturn(false);

        $user = $this->repo->addRole($userId, $roleName);
    }

    /**
     * @expectedException Restaurant\Exceptions\RepositoryException
     */
    public function testAttachRoleThrowsExceptionIfAttachFails()
    {
        $userId = 1;
        $roleName = 'role';

        $this->repoModel->shouldReceive('findOrFail')->once()->with($userId)->andReturn($this->mockUser);
        $this->repoRole->shouldReceive('where')->once()
            ->with('slug', $roleName)->andReturn($this->mockCollection);
        $this->mockCollection->shouldReceive('first')->once()->andReturn($this->mockRole);
        $this->mockUser->shouldReceive('attachRole')->once()->with($this->mockRole)->andReturn(false);

        $user = $this->repo->addRole($userId, $roleName);
    }

    public function testDetachRoleAddsRoleToAndReturnsUserModel()
    {
        $userId = 1;
        $roleName = 'role';

        $this->repoModel->shouldReceive('findOrFail')->once()->with($userId)->andReturn($this->mockUser);
        $this->repoRole->shouldReceive('where')->once()
            ->with('slug', $roleName)->andReturn($this->mockCollection);
        $this->mockCollection->shouldReceive('first')->once()->andReturn($this->mockRole);
        $this->mockUser->shouldReceive('detachRole')->once()->with($this->mockRole)->andReturn(true);

        $user = $this->repo->removeRole($userId, $roleName);
        $this->assertInstanceOf('Restaurant\Models\User', $user);
    }
    
    /**
     * @expectedException Restaurant\Exceptions\RepositoryException
     */
    public function testDetachRoleThrowsExceptionIfNoValidRole()
    {
        $userId = 1;
        $roleName = 'role';

        $this->repoModel->shouldReceive('findOrFail')->once()->with($userId)->andReturn($this->mockUser);
        $this->repoRole->shouldReceive('where')->once()
            ->with('slug', $roleName)->andReturn($this->mockCollection);
        $this->mockCollection->shouldReceive('first')->once()->andReturn(null);

        $user = $this->repo->removeRole($userId, $roleName);
    }

    /**
     * @expectedException Restaurant\Exceptions\RepositoryException
     */
    public function testDetachRoleThrowsExceptionIfDetachFails()
    {
        $userId = 1;
        $roleName = 'role';

        $this->repoModel->shouldReceive('findOrFail')->once()->with($userId)->andReturn($this->mockUser);
        $this->repoRole->shouldReceive('where')->once()
            ->with('slug', $roleName)->andReturn($this->mockCollection);
        $this->mockCollection->shouldReceive('first')->once()->andReturn($this->mockRole);
        $this->mockUser->shouldReceive('detachRole')->once()->with($this->mockRole)->andReturn(false);

        $user = $this->repo->removeRole($userId, $roleName);
    }

    public function testFindByTokenFindsAndReturnsUserModel()
    {
        $type = 'create';
        $token = 'test-token';

        $this->repoModel->shouldReceive('where')->once()->with('createToken', $token)->andReturn($this->mockCollection);
        $this->mockCollection->shouldReceive('first')->once()->andReturn($this->mockUser);

        $user = $this->repo->findByToken($token, $type);
        $this->assertInstanceOf('Restaurant\Models\User', $user);
    }

    /**
     * @expectedException Restaurant\Exceptions\RepositoryException
     */
    public function testFindByTokenThrowsExceptionWhenNoValidModelFound()
    {
        $type = 'reset';
        $token = 'test-token';

        $this->repoModel->shouldReceive('where')->once()->with('resetToken', $token)->andReturn($this->mockCollection);
        $this->mockCollection->shouldReceive('first')->once()->andReturn(null);

        $user = $this->repo->findByToken($token, $type);
    }

    public function testFindByEmailFindsAndReturnsUserModel()
    {
        $mockEmail = 'user@example.com';

        $this->repoModel->shouldReceive('where')->once()->with('email', $mockEmail)->andReturn($this->mockCollection);
        $this->mockCollection->shouldReceive('first')->once()->andReturn($this->mockUser);

        $user = $this->repo->findByEmail($mockEmail);
        $this->assertInstanceOf('Restaurant\Models\User', $user);

    }

    /**
     * @expectedException Restaurant\Exceptions\RepositoryException
     */
    public function testFindAndReturnsThrowsExceptionWhenInvalidModel()
    {
        $mockEmail = 'user@example.com';

        $this->repoModel->shouldReceive('where')->once()->with('email', $mockEmail)->andReturn($this->mockCollection);
        $this->mockCollection->shouldReceive('first')->once()->andReturn(null);

        $user = $this->repo->findByEmail($mockEmail);
    }
}
