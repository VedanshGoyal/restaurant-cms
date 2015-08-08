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
    public function __construct(User $model, Role $role)
    {
        $this->model = $model;
        $this->role = $role;
    }

    /**
     * Add role to user
     *
     * @param integer $userId
     * @param string $roleName
     * @return User
     */
    public function addRole($userId, $roleName)
    {
        $user = $this->readSingle($userId);
        $role = $this->role->where('slug', $roleName)->first();

        if (!$role || !$role instanceof Role) {
            $logData = [];

            throw new RepositoryException('Failed to find role.', $logData);
        }

        if (!$user->attachRole($role)) {
            $logData = [];

            throw new RepositoryException('Failed to attach role from  user', $logData);
        }

        return $user;
    }

    public function removeRole($userId, $roleName)
    {
        $user = $this->readSingle($userId);
        $role = $this->role->where('slug', $roleName)->first();

        if (!$role || !$role instanceof Role) {
            $logData = [];

            throw new RepositoryException('Failed to find role.', $logData);
        }

        if (!$user->detachRole($role)) {
            $logData = [];

            throw new RepositoryException('Failed to detach role from  user', $logData);
        }

        return $user;
    }
}
