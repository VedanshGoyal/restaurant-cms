<?php

namespace Restaurant\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    // Database table name
    protected $table = 'photos';

    // Mass-assignable properties
    protected $fillable = ['path', 'name'];
}
