<?php

namespace Restaurant\Repositories;

use Restaurant\Models\User;
use Bican\Roles\Models\Role;
use Restaurant\Exceptions\RepositoryException;

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
     * Add a role relation to user model
     *
     * @param integer $userId
     * @param string $roleName
     * @return User
     */
    public function addRole($userId, $roleName)
    {
        $user = $this->model->findOrFail($userId);
        $role = $this->role->where('slug', $roleName)->first();

        if (!$this->isValidRole($role) || !$user->attachRole($role)) {
            $logData =[
                'userId' => sprintf('%d', $userId),
                'roleName' => sprintf('%s', $roleName),
            ];

            throw new RepositoryException('Failed to find or attach role', $logData);
        }

        return $user;
    }

    /**
     * Remove a role relation from user model
     *
     * @param integer $userId
     * @param string $roleName
     * @return User
     */
    public function removeRole($userId, $roleName)
    {
        $user = $this->model->findOrFail($userId);
        $role = $this->role->where('slug', $roleName)->first();

        if (!$this->isValidRole($role) || !$user->detachRole($role)) {
            $logData = [
                'userId' => sprintf('%d', $userId),
                'roleName' => sprintf('%s', $roleName),
            ];

            throw new RepositoryException('Failed to find or detach role', $logData);
        }

        return $user;
    }

    protected function isValidRole($role)
    {
        if ($role && $role instanceof Role) {
            return true;
        }

        return false;
    }
}
