<?php

namespace Tests\Unit\Repositories;

use Mockery as m;

class CRUDTraitTest extends \TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->model = m::mock('Tests\Stubs\StubModel')->makePartial();
        $this->app->instance('Tests\Stubs\StubModel', $this->model);

        $this->repo = new TestRepository($this->model);
    }

    public function tearDown()
    {
        m::close();
    }

    public function testReadAllReturnsCollectionObject()
    {
        $this->model->shouldReceive('orderBy')->once()->with('id', 'desc')->andReturn($this->model);
        $this->model->shouldReceive('get')->once()->andReturn($this->mockCollection());

        $collection = $this->repo->readAll();
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $collection);
    }

    /**
     * @expectedException Restaurant\Exceptions\RepositoryException
     */
    public function testAllThrowsExceptionWhenNotCollection()
    {
        $this->model->shouldReceive('orderBy')->once()->with('id', 'desc')->andReturn($this->model);
        $this->model->shouldReceive('get')->once()->andReturn(null);

        $collection = $this->repo->readAll();
    }

    public function testReadSingleReturnsModelObject()
    {
        $modelId = 1;
        $with = ['other'];
        $mockModel = $this->mockModel();
        $mockCollection = $this->mockCollection();

        $this->model->shouldReceive('where')->once()->with('id', $modelId)->andReturn($mockCollection);
        $mockCollection->shouldReceive('with')->once()->with($with)->andReturn($mockCollection);
        $mockCollection->shouldReceive('first')->once()->andReturn($mockModel);

        $model = $this->repo->readSingle($modelId, $with);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Model', $model);
    }

    /**
     * @expectedException Restaurant\Exceptions\RepositoryException
     */
    public function testReadSingleThrowsExceptionWhenNotModel()
    {
        $modelId = 1;
        $with = ['other'];
        $mockModel = $this->mockModel();
        $mockCollection = $this->mockCollection();

        $this->model->shouldReceive('where')->once()->with('id', $modelId)->andReturn($mockCollection);
        $mockCollection->shouldReceive('with')->once()->with($with)->andReturn($mockCollection);
        $mockCollection->shouldReceive('first')->once()->andReturn(null);

        $model = $this->repo->readSingle($modelId, $with);
    }

    public function testCreateMakesAndReturnsModelObject()
    {
        $input = ['test' => 'input'];
        $mockModel = $this->mockModel();

        $this->model->shouldReceive('create')->once()->with($input)->andReturn($mockModel);

        $model = $this->repo->create($input);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Model', $model);
    }

    /**
     * @expectedException Restaurant\Exceptions\RepositoryException
     */
    public function testCreateThrowsExceptionWhenFails()
    {
        $input = ['test' => 'input'];
        $mockModel = $this->mockModel();

        $this->model->shouldReceive('create')->once()->with($input)->andReturn(null);

        $model = $this->repo->create($input);
    }

    public function testUpdateFindsUpdatesAndReturnsModelObject()
    {
        $modelId = 1;
        $input = ['test' => 'input'];
        $mockModel = $this->mockModel();

        $this->model->shouldReceive('find')->once()->with($modelId)->andReturn($mockModel);
        $mockModel->shouldReceive('update')->once()->with($input)->andReturn(true);

        $model = $this->repo->update($modelId, $input);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Model', $model);
    }

    /**
     * @expectedException Restaurant\Exceptions\RepositoryException
     */
    public function testUpdateThrowsExceptionWhenFails()
    {
        $modelId = 1;
        $input = ['test' => 'input'];
        $mockModel = $this->mockModel();

        $this->model->shouldReceive('find')->once()->with($modelId)->andReturn($mockModel);
        $mockModel->shouldReceive('update')->once()->with($input)->andReturn(false);

        $model = $this->repo->update($modelId, $input);
    }

    public function testDeleteReturnsTrueWhenSuccessful()
    {
        $modelId = 1;
        $mockModel = $this->mockModel();

        $this->model->shouldReceive('find')->once()->with($modelId)->andReturn($mockModel);
        $mockModel->shouldReceive('delete')->once()->andReturn(true);

        $this->assertTrue($this->repo->delete($modelId));
    }

    /**
     * @expectedException Restaurant\Exceptions\RepositoryException
     */
    public function testDeleteThrowsExceptionWhenFails()
    {
        $modelId = 1;
        $mockModel = $this->mockModel();

        $this->model->shouldReceive('find')->once()->with($modelId)->andReturn($mockModel);
        $mockModel->shouldReceive('delete')->once()->andReturn(false);

        $this->repo->delete($modelId);
    }

    protected function mockCollection()
    {
        return m::mock('Illuminate\Database\Eloquent\Collection')->makePartial();
    }

    protected function mockModel()
    {
        return m::mock('Illuminate\Database\Eloquent\Model')->makePartial();
    }
}
