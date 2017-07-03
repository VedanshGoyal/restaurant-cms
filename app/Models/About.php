<?php

namespace RestaurantCMS\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    // @var string - DB table name
    protected $table = 'about';

    // @var array - mass-assignable properties
    protected $fillable = ['title', 'content'];

    // @var array<string> - Fields to be hidden when doing array/json serialization
    protected $hidden = ['created_at', 'updated_at', 'id'];
}
