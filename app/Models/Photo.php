<?php

namespace RestaurantCMS\Models;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;

class Photo extends Model
{
    use Eloquence, Mappable;

    // @var string - DB table name
    protected $table = 'photos';

    // @var array<string> - Mass-assignable fields
    protected $fillable = ['sortId', 'path'];

    // @var array - Property name maps
    protected $maps = [
        'sortId' => 'sort_id',
        'createdAt' => 'created_at',
        'updatedAt' => 'updated_at',
    ];

    // @var array<string> - Fields to be hidden when doing array/json serialization
    protected $hidden = ['sort_id', 'created_at', 'updated_at'];

    // @var array<string> - Fields to be added when doing array/json serialization
    protected $appends = ['sortId', 'createdAt', 'updatedAt'];
}
