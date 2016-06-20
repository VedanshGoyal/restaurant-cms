<?php

namespace Tests\Unit\Controllers;

use Mockery as m;
use Restaurant\Http\Controllers\PhotosController;

class PhotosControllerTest extends \TestCase
{
    public function setUp()
    {
        $this->mockRepo = m::mock('Restaurant\Repositories\PhotoRepo')->makePartial();
        $this->mockRequest = m::mock('Restaurant\Http\Requests\PhotoRequest')->makePartial();
        $this->mockResponse = m::mock('Illuminate\Http\JsonResponse')->makePartial();
        $this->mockService = m::mock('Restaurant\Services\FilesystemService')->makePartial();
        $this->mockFile = m::mock('Symfony\Component\HttpFoundation\File\UploadedFile')->makePartial();

        $this->controller = new PhotosController(
            $this->mockRepo,
            $this->mockRequest,
            $this->mockResponse,
            $this->mockService
        );
    }

    public function tearDown()
    {
        m::close();
    }

    public function testStoreRequestNoFileReturnsErrorResponse()
    {
        $this->mockRequest->shouldReceive('hasFile')->once()->with(m::type('string'))->andReturn(false);
        $this->mockResponse->shouldReceive('create')->once()->with(m::type('array'), 400)
            ->andReturn($this->mockResponse);

        $response = $this->controller->store();
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    public function testStoreRequestFileNotValidReturnsErrorResponse()
    {
        $this->mockRequest->shouldReceive('hasFile')->once()->with(m::type('string'))->andReturn(true);
        $this->mockRequest->shouldReceive('file')->once()->with(m::type('string'))->andReturn($this->mockFile);
        $this->mockFile->shouldReceive('isValid')->once()->andReturn(false);
        $this->mockResponse->shouldReceive('create')->once()->with(m::type('array'), 400)
            ->andReturn($this->mockResponse);

        $response = $this->controller->store();
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    public function testStoreAddFailReturnsErrorResponse()
    {
        $this->mockRequest->shouldReceive('hasFile')->once()->with(m::type('string'))->andReturn(true);
        $this->mockRequest->shouldReceive('file')->twice()->with(m::type('string'))->andReturn($this->mockFile);
        $this->mockFile->shouldReceive('isValid')->once()->andReturn(true);
        $this->mockService->shouldReceive('add')->once()->with($this->mockFile)->andReturn(false);
        $this->mockResponse->shouldReceive('create')->once()->with(m::type('array'), 500)
            ->andReturn($this->mockResponse);

        $response = $this->controller->store();
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    public function testStoreSuccessReturnsOkResponse()
    {
        $this->mockRequest->shouldReceive('hasFile')->once()->with(m::type('string'))->andReturn(true);
        $this->mockRequest->shouldReceive('file')->twice()->with(m::type('string'))->andReturn($this->mockFile);
        $this->mockFile->shouldReceive('isValid')->once()->andReturn(true);
        $this->mockService->shouldReceive('add')->once()->with($this->mockFile)->andReturn(true);
        $this->mockResponse->shouldReceive('create')->once()->with(m::type('array'))
            ->andReturn($this->mockResponse);

        $response = $this->controller->store();
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    public function testDestroyRemoveFailReturnsErrorResponse()
    {
        $this->mockService->shouldReceive('remove')->once()->with(m::type('integer'))->andReturn(false);
        $this->mockResponse->shouldReceive('create')->once()->with(m::type('array'), 500)
            ->andReturn($this->mockResponse);

        $response = $this->controller->destroy(1000);
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }

    public function testDestroySuccessReturnsOkResponse()
    {
        $this->mockService->shouldReceive('remove')->once()->with(m::type('integer'))->andReturn(true);
        $this->mockResponse->shouldReceive('create')->once()->with(m::type('array'))
            ->andReturn($this->mockResponse);

        $response = $this->controller->destroy(1000);
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
    }
}
