<?php

namespace Restaurant\Models;

use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{
    // @var string - DB Table name
    protected $table = 'hours';

    // @var array - mass-assignable properties
    protected $fillable = ['day', 'open', 'close'];
}
