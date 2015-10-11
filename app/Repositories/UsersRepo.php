<?php

namespace Restaurant\Repositories;

use Restaurant\Models\User;
use Restaurant\Exceptions\RepositoryException;

class UsersRepo extends CRUDRepo
{
    /**
     * Initialize new instance
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Find user model by the token type specified
     *
     * @param string $token
     * @param string $type - create|reset
     * @return User
     */
    public function findByToken($token, $type)
    {
        $tokenType = "{$type}Token";
        $user = $this->model->where($tokenType, $token)->first();

        return $user;
    }

    /**
     * Find a user model by email address
     *
     * @param string $email
     * @return User $user
     */
    public function findByEmail($email)
    {
        $user = $this->model->where('email', $email)->first();

        return $user;
    }
}
