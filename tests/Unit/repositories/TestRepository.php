<?php
namespace Tests\Unit\Repositories;

use Restaurant\Repositories\CRUDTrait;
use Tests\Stubs\StubModel;

class TestRepository
{
    use CRUDTrait;

    public function __construct(StubModel $model)
    {
        $this->model = $model;
    }
}
