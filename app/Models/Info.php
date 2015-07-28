<?php

namespace Restaurant\Models;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    // Database table name
    protected $table = 'info';

    // Mass-assignable properties
    protected $fillable = ['name', 'street', 'city', 'state', 'phoneOne', 'phoneTwo'];
}
