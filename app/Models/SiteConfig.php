<?php

namespace RestaurantCMS\Models;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;

class SiteConfig extends Model
{
    use Eloquence, Mappable;

    // @var string - DB table name
    protected $table = 'site_config';

    // @var array - mass-assignable properties
    protected $fillable = ['allow_reg'];

    // @var array - Property name maps
    protected $maps = ['allowReg' => 'allow_reg', 'updatedAt' => 'updated_at'];

    // @var array<string> - Fields to be hidden when doing array/json serialization
    protected $hidden = ['allow_reg', 'updated_at'];

    // @var array<string> - Fields to be added when doing array/json serialization
    protected $appends = ['allowReg', 'updatedAt'];
}
