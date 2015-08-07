<?php

namespace Tests\Unit\Controllers;

use Mockery as m;

class RESTTraitTest extends \TestCase
{
    protected $mockInput = ['test' => 'input'];
    protected $modelId = 1;

    public function setUp()
    {
        $this->mockModel = $this->getMockModel();
        $this->mockCollection = $this->getMockCollection();
        $this->mockRepo = m::mock('Tests\Unit\Repositories\TestRepository')->makePartial();
        $this->mockRequest = m::mock('Illuminate\Http\Request')->makePartial();
        $this->mockResponse = m::mock('Illuminate\Http\JsonResponse')->makePartial();

        $this->controller = new TestController($this->mockRepo, $this->mockRequest, $this->mockResponse);
    }

    public function tearDown()
    {
        m::close();
    }

    public function testIndexReturnsCollectionAsJSON()
    {
        $this->mockRepo->shouldReceive('readAll')->once()->with(['values'])->andReturn($this->mockCollection);
        $this->mockResponse->shouldReceive('create')->once()
            ->with($this->mockCollection)->andReturn($this->mockResponse);

        $response = $this->controller->index();

        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
        
    }

    public function testStoreReturnsJSONModel()
    {
        $this->mockRequest->shouldReceive('only')->once()->with(['white' => 'list'])->andReturn($this->mockInput);
        $this->mockRepo->shouldReceive('create')->once()->with($this->mockInput)->andReturn($this->mockModel);
        $this->mockResponse->shouldReceive('create')->once()->with($this->mockModel)->andReturn($this->mockResponse);

        $response = $this->controller->store();

        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    public function testShowReturnsJSONModel()
    {
        $this->mockRepo->shouldReceive('readSingle')->once()->with($this->modelId)->andReturn($this->mockModel);
        $this->mockResponse->shouldReceive('create')->once()->with($this->mockModel)->andReturn($this->mockResponse);

        $response = $this->controller->show($this->modelId);

        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    public function testUpdateUpdatesAndReturnsJSONModel()
    {
        $this->mockRequest->shouldReceive('only')->once()->with(['white' => 'list'])->andReturn($this->mockInput);
        $this->mockRepo->shouldReceive('update')->once()
            ->with($this->modelId, $this->mockInput)->andReturn($this->mockModel);
        $this->mockResponse->shouldReceive('create')->once()->with($this->mockModel)->andReturn($this->mockResponse);

        $response = $this->controller->update($this->modelId);

        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    public function testDestroyDeletesAndReturnsJSONResponse()
    {
        $this->mockRepo->shouldReceive('delete')->once()->with($this->modelId)->andReturn(true);
        $this->mockResponse->shouldReceive('create')->once()->with(['ok' => true])->andReturn($this->mockResponse);

        $response = $this->controller->destroy($this->modelId);

        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }
}
