<?php

namespace Restaurant\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    // @var string - DB Table name
    protected $table = 'about';

    // @var array - mass-assignable properties
    protected $fillable = ['title', 'content'];
}
