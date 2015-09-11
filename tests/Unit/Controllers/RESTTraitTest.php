<?php

namespace Tests\Unit\Controllers;

use Mockery as m;

class RESTTraitTest extends \TestCase
{
    private $mockInput = ['mock' => 'input'];

    public function setUp()
    {
        $this->mockModel = $this->getMockModel();
        $this->mockCollection = $this->getMockCollection();
        $this->mockRepo = m::mock('Restaurant\Repositories\CRUDRepo', [$this->mockModel])->makePartial();
        $this->mockRequest = m::mock('Illuminate\Http\Request')->makePartial();
        $this->mockResponse = m::mock('Illuminate\Http\JsonResponse')->makePartial();

        $this->controller = new TestController($this->mockRepo, $this->mockRequest, $this->mockResponse);
    }

    public function tearDown()
    {
        m::close();
    }

    public function testIndexReturnsCollection()
    {
        $this->mockRepo->shouldReceive('readAll')->once()->withNoArgs()->andReturn($this->mockCollection);
        $this->mockResponse->shouldReceive('create')->once()->with($this->mockCollection)
            ->andReturn($this->mockResponse);

        $response = $this->controller->index();
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
        
    }

    public function testIndexReturnsErrorIfNoCollection()
    {
        $this->mockRepo->shouldReceive('readAll')->once()->andReturn(false);
        $this->mockResponse->shouldReceive('create')->once()->with(m::type('array'), 404)
            ->andReturn($this->mockResponse);

        $response = $this->controller->index();
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    public function testStoreCreatesAndReturnsModel()
    {
        $this->mockRequest->shouldReceive('only')->once()->with(m::type('array'))->andReturn($this->mockInput);
        $this->mockRepo->shouldReceive('create')->once()->with(m::type('array'))->andReturn($this->mockModel);
        $this->mockResponse->shouldReceive('create')->once()->with($this->mockModel)->andReturn($this->mockResponse);

        $response = $this->controller->store();
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    public function testStoreReturnsErrorIfNoModel()
    {
        $this->mockRequest->shouldReceive('only')->once()->with(m::type('array'))->andReturn($this->mockInput);
        $this->mockRepo->shouldReceive('create')->once()->with(m::type('array'))->andReturn(false);
        $this->mockResponse->shouldReceive('create')->once()->with(m::type('array'), 400)
            ->andReturn($this->mockResponse);

        $response = $this->controller->store();
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    public function testShowReturnsJSONModel()
    {
        $this->mockRepo->shouldReceive('readSingle')->once()->with(m::type('integer'))->andReturn($this->mockModel);
        $this->mockResponse->shouldReceive('create')->once()->with($this->mockModel)->andReturn($this->mockResponse);

        $response = $this->controller->show(1);
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    public function testShowReturnsErrorNoModel()
    {
        $this->mockRepo->shouldReceive('readSingle')->once()->with(m::type('integer'))->andReturn(false);
        $this->mockResponse->shouldReceive('create')->once()->with(m::type('array'), 404)
            ->andReturn($this->mockResponse);

        $response = $this->controller->show(1);
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    public function testUpdateUpdatesAndReturnsJSONModel()
    {
        $this->mockRequest->shouldReceive('only')->once()->with(m::type('array'))->andReturn($this->mockInput);
        $this->mockRepo->shouldReceive('update')->once()->with(m::type('integer'), m::type('array'))
            ->andReturn($this->mockModel);
        $this->mockResponse->shouldReceive('create')->once()->with($this->mockModel)->andReturn($this->mockResponse);

        $response = $this->controller->update(1);
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    public function testUpdateReturnsErrorNoModel()
    {
        $this->mockRequest->shouldReceive('only')->once()->with(m::type('array'))->andReturn($this->mockInput);
        $this->mockRepo->shouldReceive('update')->once()->with(m::type('integer'), m::type('array'))
            ->andReturn(false);
        $this->mockResponse->shouldReceive('create')->once()->with(m::type('array'), 400)
            ->andReturn($this->mockResponse);

        $response = $this->controller->update(1);
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    public function testDestroyDeletesAndReturnsJSONResponse()
    {
        $this->mockRepo->shouldReceive('delete')->once()->with(m::type('integer'))->andReturn(true);
        $this->mockResponse->shouldReceive('create')->once()->with(m::type('array'))->andReturn($this->mockResponse);

        $response = $this->controller->destroy(1);
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    public function testDestroyReturnsErrorDeleteFails()
    {
        $this->mockRepo->shouldReceive('delete')->once()->with(m::type('integer'))->andReturn(false);
        $this->mockResponse->shouldReceive('create')->once()->with(m::type('array'), 400)
            ->andReturn($this->mockResponse);

        $response = $this->controller->destroy(1);
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }
}
