<?php

namespace Restaurant\Roles;

use Zizaco\Entrust\EntrustRole;

class Owner extends EntrustRole
{
    // @var string
    protected $name = 'owner';

    // @var string
    protected $display_name = 'Owner';

    // @var string
    protected $description = 'Content editor';
}
