<?php

namespace Tests\Unit\Services;

use Mockery as m;
use Restaurant\Services\FilesystemService;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FilesystemServiceTest extends \TestCase
{
    public function setUp()
    {
        system('touch /tmp/test.txt');
        $this->mockRepo = m::mock('Restaurant\Repositories\PhotoRepo')->makePartial();
        $this->mockFilesystem = m::mock('Illuminate\Contracts\Filesystem\Filesystem')->makePartial();

        $this->service = new FilesystemService($this->mockRepo, $this->mockFilesystem);
    }

    public function tearDown()
    {
        system('rm /tmp/test.txt');
        m::close();
    }

    public function testAddSuccessReturnsTrue()
    {
        $file = new UploadedFile('/tmp/test.txt', 'test');

        $this->mockFilesystem->shouldReceive('put')->once()->with(m::type('string'), m::type('string'))
            ->andReturn(true);
        $this->mockRepo->shouldReceive('create')->once()->with(m::type('array'))->andReturn(true);

        $this->assertTrue($this->service->add($file));
    }

    public function testAddMoveFileFailsReturnsFalse()
    {
        $file = new UploadedFile('/tmp/test.txt', 'test');

        $this->mockFilesystem->shouldReceive('put')->once()->with(m::type('string'), m::type('string'))
            ->andReturn(false);
        $this->mockRepo->shouldReceive('create')->never();

        $this->assertFalse($this->service->add($file));
    }

    public function testAddRepoCreateFailsReturnsFalse()
    {
        $file = new UploadedFile('/tmp/test.txt', 'test');

        $this->mockFilesystem->shouldReceive('put')->once()->with(m::type('string'), m::type('string'))
            ->andReturn(true);
        $this->mockRepo->shouldReceive('create')->once()->with(m::type('array'))->andReturn(false);

        $this->assertFalse($this->service->add($file));
    }

    public function testRemoveSuccessReturnsTrue()
    {
        $model = new \stdClass();
        $model->path = 'path';
        $this->mockRepo->shouldReceive('readSingle')->once()->with(m::type('integer'))->andReturn($model);
        $this->mockFilesystem->shouldReceive('exists')->once()->with(m::type('string'))->andReturn(true);
        $this->mockRepo->shouldReceive('delete')->once()->with(m::type('integer'));
        $this->mockFilesystem->shouldReceive('delete')->once()->with(m::type('string'));

        $this->assertTrue($this->service->remove(1000));
    }

    public function testRemoveNoModelReturnsFalse()
    {
        $this->mockRepo->shouldReceive('readSingle')->once()->with(m::type('integer'))->andReturn(false);
        $this->mockFilesystem->shouldReceive('exists')->never();
        $this->mockRepo->shouldReceive('delete')->never();
        $this->mockFilesystem->shouldReceive('delete')->never();

        $this->assertFalse($this->service->remove(1000));

    }

    public function testRemoveNoFileReturnsFalse()
    {
        $model = new \stdClass();
        $model->path = 'path';
        $this->mockRepo->shouldReceive('readSingle')->once()->with(m::type('integer'))->andReturn($model);
        $this->mockFilesystem->shouldReceive('exists')->once()->with(m::type('string'))->andReturn(false);
        $this->mockRepo->shouldReceive('delete')->never();
        $this->mockFilesystem->shouldReceive('delete')->never();

        $this->assertFalse($this->service->remove(1000));
    }
}
