<?php

namespace Tests\Unit\Repositories;

use Mockery as m;
use Restaurant\Repositories\UsersRepo;

class UsersRepoTest extends \TestCase
{
    public function setUp()
    {
        $this->repoModel = m::mock('Restaurant\Models\User')->makePartial();

        $this->mockUser = m::mock('Restaurant\Models\User')->makePartial();
        $this->mockRole = m::mock('Bican\Roles\Models\Role')->makePartial();
        $this->mockCollection = $this->getMockCollection();

        $this->repo = new UsersRepo($this->repoModel);
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
        $this->mockUser->shouldReceive('attachRole')->once()->with($this->mockRole)->andReturn(true);

        $user = $this->repo->addRole($userId, $this->mockRole);
        $this->assertInstanceOf('Restaurant\Models\User', $user);
    }
    
    /**
     * @expectedException Restaurant\Exceptions\RepositoryException
     */
    public function testAttachRoleThrowsExceptionIfAttachFails()
    {
        $userId = 1;

        $this->repoModel->shouldReceive('findOrFail')->once()->with($userId)->andReturn($this->mockUser);
        $this->mockUser->shouldReceive('attachRole')->once()->with($this->mockRole)->andReturn(false);

        $user = $this->repo->addRole($userId, $this->mockRole);
    }

    public function testDetachRoleAddsRoleToAndReturnsUserModel()
    {
        $userId = 1;

        $this->repoModel->shouldReceive('findOrFail')->once()->with($userId)->andReturn($this->mockUser);
        $this->mockUser->shouldReceive('detachRole')->once()->with($this->mockRole)->andReturn(true);

        $user = $this->repo->removeRole($userId, $this->mockRole);
        $this->assertInstanceOf('Restaurant\Models\User', $user);
    }

    /**
     * @expectedException Restaurant\Exceptions\RepositoryException
     */
    public function testDetachRoleThrowsExceptionIfDetachFails()
    {
        $userId = 1;

        $this->repoModel->shouldReceive('findOrFail')->once()->with($userId)->andReturn($this->mockUser);
        $this->mockUser->shouldReceive('detachRole')->once()->with($this->mockRole)->andReturn(false);

        $user = $this->repo->removeRole($userId, $this->mockRole);
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

    public function testFindByEmailFindsAndReturnsUserModel()
    {
        $mockEmail = 'user@example.com';

        $this->repoModel->shouldReceive('where')->once()->with('email', $mockEmail)->andReturn($this->mockCollection);
        $this->mockCollection->shouldReceive('first')->once()->andReturn($this->mockUser);

        $user = $this->repo->findByEmail($mockEmail);
        $this->assertInstanceOf('Restaurant\Models\User', $user);

    }
}
