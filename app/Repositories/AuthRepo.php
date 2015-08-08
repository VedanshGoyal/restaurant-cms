<?php

namespace Restaurant\Repositories;

use Restaurant\Models\User;

class AuthRepo
{
    use CRUDTrait;

    /**
     * Initialize new instance
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
