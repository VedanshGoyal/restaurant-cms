<?php

namespace Restaurant\Repositories;

class MenuSectionRepo extends CRUDRepo
{
    // @var array - relations to eager load
    protected $with = ['items'];
}
