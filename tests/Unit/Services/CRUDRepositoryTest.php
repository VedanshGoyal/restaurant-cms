<?php

namespace Tests\Unit\Services;

use Mockery as m;
use Restaurant\Services\CRUDRepository;

class CRUDRepositoryTest extends \TestCase
{
    protected $modelId = 1;
    protected $with = ['stock'];
    protected $input = ['test' => 'input'];
    protected $mockModel;
    protected $mockCollection;
    protected $repoModel;

    public function setUp()
    {
        parent::setUp();

        $this->repoModel = m::mock('Illuminate\Database\Eloquent\Model')->makePartial();
        $this->app->instance('Tests\Stubs\StubModel', $this->repoModel);
        $this->mockModel = $this->getMockModel();
        $this->mockCollection = $this->getMockCollection();

        $this->repo = new CRUDRepository($this->repoModel);
    }

    public function tearDown()
    {
        m::close();
    }

    public function testReadAllReturnsCollectionObject()
    {
        $this->repoModel->shouldReceive('with')->once()->with($this->with)->andReturn($this->repoModel);
        $this->repoModel->shouldReceive('orderBy')->once()->with('id', 'desc')->andReturn($this->repoModel);
        $this->repoModel->shouldReceive('get')->once()->andReturn($this->mockCollection);

        $collection = $this->repo->readAll($this->with);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $collection);
    }

    /**
     * @expectedException Restaurant\Exceptions\RepositoryException
     */
    public function testAllThrowsExceptionWhenNotCollection()
    {
        $this->repoModel->shouldReceive('with')->once()->with($this->with)->andReturn($this->repoModel);
        $this->repoModel->shouldReceive('orderBy')->once()->with('id', 'desc')->andReturn($this->repoModel);
        $this->repoModel->shouldReceive('get')->once()->andReturn(null);

        $collection = $this->repo->readAll($this->with);
    }

    public function testReadSingleReturnsModelObject()
    {
        $this->repoModel->shouldReceive('where')->once()
            ->with('id', $this->modelId)->andReturn($this->mockCollection);
        $this->mockCollection->shouldReceive('with')->once()->with($this->with)->andReturn($this->mockCollection);
        $this->mockCollection->shouldReceive('first')->once()->andReturn($this->mockModel);

        $model = $this->repo->readSingle($this->modelId, $this->with);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Model', $model);
    }

    /**
     * @expectedException Restaurant\Exceptions\RepositoryException
     */
    public function testReadSingleThrowsExceptionWhenNotModel()
    {
        $this->repoModel->shouldReceive('where')->once()
            ->with('id', $this->modelId)->andReturn($this->mockCollection);
        $this->mockCollection->shouldReceive('with')->once()->with($this->with)->andReturn($this->mockCollection);
        $this->mockCollection->shouldReceive('first')->once()->andReturn(null);

        $model = $this->repo->readSingle($this->modelId, $this->with);
    }

    public function testCreateMakesAndReturnsModelObject()
    {
        $this->repoModel->shouldReceive('create')->once()->with($this->input)->andReturn($this->mockModel);

        $model = $this->repo->create($this->input);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Model', $model);
    }

    /**
     * @expectedException Restaurant\Exceptions\RepositoryException
     */
    public function testCreateThrowsExceptionWhenFails()
    {
        $this->repoModel->shouldReceive('create')->once()->with($this->input)->andReturn(null);

        $model = $this->repo->create($this->input);
    }

    public function testUpdateFindsUpdatesAndReturnsModelObject()
    {
        $this->repoModel->shouldReceive('find')->once()->with($this->modelId)->andReturn($this->mockModel);
        $this->mockModel->shouldReceive('update')->once()->with($this->input)->andReturn(true);

        $model = $this->repo->update($this->modelId, $this->input);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Model', $model);
    }

    /**
     * @expectedException Restaurant\Exceptions\RepositoryException
     */
    public function testUpdateThrowsExceptionWhenFails()
    {
        $this->repoModel->shouldReceive('find')->once()->with($this->modelId)->andReturn($this->mockModel);
        $this->mockModel->shouldReceive('update')->once()->with($this->input)->andReturn(false);

        $model = $this->repo->update($this->modelId, $this->input);
    }

    public function testDeleteReturnsTrueWhenSuccessful()
    {
        $this->repoModel->shouldReceive('find')->once()->with($this->modelId)->andReturn($this->mockModel);
        $this->mockModel->shouldReceive('delete')->once()->andReturn(true);

        $this->assertTrue($this->repo->delete($this->modelId));
    }

    /**
     * @expectedException Restaurant\Exceptions\RepositoryException
     */
    public function testDeleteThrowsExceptionWhenFails()
    {
        $this->repoModel->shouldReceive('find')->once()->with($this->modelId)->andReturn($this->mockModel);
        $this->mockModel->shouldReceive('delete')->once()->andReturn(false);

        $this->repo->delete($this->modelId);
    }

    protected function getMockCollection()
    {
        return m::mock('Illuminate\Database\Eloquent\Collection')->makePartial();
    }

    protected function getMockModel()
    {
        return m::mock('Illuminate\Database\Eloquent\Model')->makePartial();
    }
}
