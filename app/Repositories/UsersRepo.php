<?php

namespace Restaurant\Repositories;

use Restaurant\Models\User;
use Bican\Roles\Models\Role;
use Restaurant\Exceptions\RepositoryException;

class UsersRepo
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

    /**
     * Add a role relation to user model
     *
     * @param integer $userId
     * @param Role $role
     * @return User
     */
    public function addRole($userId, Role $role)
    {
        $user = $this->model->findOrFail($userId);

        if (!$user->attachRole($role)) {
            $logData =[
                'repository_model' => print_r($this->model, true),
                'query_model' => print_r($user, true),
                'query_id' => sprintf('%d', $userId),
                'role' => print_r($role, true),
            ];

            throw new RepositoryException('Failed to attach role to user.', $logData);
        }

        return $user;
    }

    /**
     * Remove a role relation from user model
     *
     * @param integer $userId
     * @param Role $role
     * @return User
     */
    public function removeRole($userId, $role)
    {
        $user = $this->model->findOrFail($userId);

        if (!$user->detachRole($role)) {
            $logData =[
                'repository_model' => print_r($this->model, true),
                'query_model' => print_r($user, true),
                'query_id' => sprintf('%d', $userId),
                'role' => print_r($role, true),
            ];

            throw new RepositoryException('Failed to remove role from user.', $logData);
        }

        return $user;
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
