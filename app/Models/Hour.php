<?php

namespace RestaurantCMS\Models;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;

class Hour extends Model
{
    use Eloquence, Mappable;

    // @var string - DB table name
    protected $table = 'hours';

    // @var array - mass-assignable properties
    protected $fillable = ['day', 'open', 'close', 'isClosed'];

    // @var array - Property name maps
    protected $maps = ['isClosed' => 'is_closed'];

    // @var array<string> - Fields to be hidden when doing array/json serialization
    protected $hidden = ['is_closed', 'created_at', 'updated_at'];

    // @var array<string> - Fields to be added when doing array/json serialization
    protected $appends = ['isClosed'];
}
