<?php

namespace Restaurant\Models;

use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{
    // Database table name
    protected $table = 'hours';

    // Mass-assignable properties
    protected $fillable = ['day', 'open', 'close'];
}
