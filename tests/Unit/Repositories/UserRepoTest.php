<?php

namespace Tests\Unit\Repositories;

use Mockery as m;
use Restaurant\Repositories\UsersRepo;

class UsersRepoTest extends \TestCase
{
    public function setUp()
    {
        $this->mockModel = m::mock('Restaurant\Models\User')->makePartial();
        $this->mockUser = m::mock('Restaurant\Models\User')->makePartial();
        $this->mockCollection = $this->getMockCollection();

        $this->repo = new UsersRepo($this->mockModel);
    }

    public function tearDown()
    {
        m::close();
    }

    public function testFindByTokenFindsAndReturnsUserModel()
    {
        $type = 'create';
        $token = 'test-token';

        $this->mockModel->shouldReceive('where')->once()->with('createToken', $token)->andReturn($this->mockCollection);
        $this->mockCollection->shouldReceive('first')->once()->andReturn($this->mockUser);

        $user = $this->repo->findByToken($token, $type);
        $this->assertInstanceOf('Restaurant\Models\User', $user);
    }

    public function testFindByEmailFindsAndReturnsUserModel()
    {
        $mockEmail = 'user@example.com';

        $this->mockModel->shouldReceive('where')->once()->with('email', $mockEmail)->andReturn($this->mockCollection);
        $this->mockCollection->shouldReceive('first')->once()->andReturn($this->mockUser);

        $user = $this->repo->findByEmail($mockEmail);
        $this->assertInstanceOf('Restaurant\Models\User', $user);
    }
}
