<?php

namespace Restaurant\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    // @var string - DB Table name
    protected $table = 'photos';

    // @var array - mass-assignable properties
    protected $fillable = ['path'];
}
