<?php

namespace Tests\Unit\Repositories;

use Restaurant\Repositories\CRUDTrait;

class TestRepository
{
    use CRUDTrait;

    public function __construct($model)
    {
        $this->model = $model;
    }
}
