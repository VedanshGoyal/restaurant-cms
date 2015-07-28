<?php

namespace Restaurant\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    // Database table name
    protected $table = 'about';

    // Mass-assignable properties
    protected $fillable = ['title', 'content'];
}
