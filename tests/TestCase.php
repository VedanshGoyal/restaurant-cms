<?php

namespace Tests;

use Mockery as m;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function getMockCollection()
    {
        return m::mock('Illuminate\Database\Eloquent\Collection')->makePartial();
    }

    protected function getMockModel()
    {
        return m::mock('Illuminate\Database\Eloquent\Model')->makePartial();
    }
}
