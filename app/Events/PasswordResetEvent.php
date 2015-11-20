<?php

namespace Restaurant\Events;

use Restaurant\Events\Event;
use Restaurant\Models\User;

class PasswordResetEvent extends Event
{
    // @var Restaurant\Models\User
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
