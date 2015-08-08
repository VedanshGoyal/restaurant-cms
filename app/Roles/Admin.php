<?php

namespace Restaurant\Roles;

use Zizaco\Entrust\EntrustRole;

class Admin extends EntrustRole
{
    // @var string
    protected $name = 'admin';

    // @var string
    protected $display_name = 'Admin';

    // @var string
    protected $description = 'Super user account';
}
