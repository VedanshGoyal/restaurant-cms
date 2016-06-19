<?php

namespace Restaurant\Models;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    // @var string - DB Table name
    protected $table = 'info';

    // @var array - mass-assignable properties
    protected $fillable = ['name', 'street', 'city', 'state', 'zip', 'phone_one', 'phone_two'];
}
