<?php

namespace Tests\Unit\Repositories;

use Mockery as m;
use Restaurant\Repositories\CRUDRepo;
use Illuminate\Support\Facades\DB;

class CRUDRepositoryTest extends \TestCase
{
    protected $modelId = 1;
    protected $input = ['test' => 'input'];

    public function setUp()
    {
        parent::setUp();

        $this->repoModel = m::mock('Illuminate\Database\Eloquent\Model')->makePartial();
        $this->mockModel = $this->getMockModel();
        $this->mockCollection = $this->getMockCollection();

        $this->repo = new CRUDRepo($this->repoModel);
    }

    public function tearDown()
    {
        m::close();
    }

    public function testReadAllReturnsCollectionObject()
    {
        $this->repoModel->shouldReceive('with')->once()->with(m::type('array'))->andReturn($this->repoModel);
        $this->repoModel->shouldReceive('orderBy')->once()->with('id', 'desc')->andReturn($this->repoModel);
        $this->repoModel->shouldReceive('get')->once()->andReturn($this->mockCollection);

        $collection = $this->repo->readAll();
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $collection);
    }

    public function testReadSingleReturnsModelObject()
    {
        $this->repoModel->shouldReceive('where')->once()
            ->with('id', $this->modelId)->andReturn($this->mockCollection);
        $this->mockCollection->shouldReceive('with')->once()->with(m::type('array'))->andReturn($this->mockCollection);
        $this->mockCollection->shouldReceive('first')->once()->andReturn($this->mockModel);

        $model = $this->repo->readSingle($this->modelId);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Model', $model);
    }

    public function testCreateMakesAndReturnsModelObject()
    {
        $this->repoModel->shouldReceive('create')->once()->with($this->input)->andReturn($this->mockModel);

        $model = $this->repo->create($this->input);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Model', $model);
    }

    public function testUpdateFindsUpdatesAndReturnsModelObject()
    {
        $this->repoModel->shouldReceive('find')->once()->with($this->modelId)->andReturn($this->mockModel);
        $this->mockModel->shouldReceive('update')->once()->with($this->input)->andReturn($this->mockModel);

        $model = $this->repo->update($this->modelId, $this->input);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Model', $model);
    }

    public function testDeleteReturnsTrueWhenSuccessful()
    {
        $this->repoModel->shouldReceive('find')->once()->with($this->modelId)->andReturn($this->mockModel);
        $this->mockModel->shouldReceive('delete')->once()->andReturn(true);

        $this->assertTrue($this->repo->delete($this->modelId));
    }
}
