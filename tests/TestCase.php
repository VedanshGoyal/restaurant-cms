<?php
// @codingStandardsIgnoreFile

use Mockery as m;

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
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
