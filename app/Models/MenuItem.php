<?php

namespace RestaurantCMS\Models;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;

class MenuItem extends Model
{
    use Eloquence, Mappable;

    // @var string - DB table name
    protected $table = 'menu_items';

    // @var array<string> - Mass-assignable fields
    protected $fillable = ['sectionId', 'name', 'description'];

    // @var array - Property name maps
    protected $maps = [
        'sectionId' => 'section_id',
        'createdAt' => 'created_at',
        'updatedAt' => 'updated_at',
    ];

    // @var array<string> - Fields to be hidden when doing array/json serialization
    protected $hidden = ['section_id', 'created_at', 'updated_at'];

    // @var array<string> - Fields to be added when doing array/json serialization
    protected $appends = ['sectionId', 'createdAt', 'updatedAt'];

    /**
     * Has-many ItemPrice
     *
     * @return HasMany
     */
    public function prices()
    {
        return $this->hasMany(\RestaurantCMS\Models\ItemPrice::class, 'item_id');
    }

    /**
     * Belongs-to MenuSection
     *
     * @return BelongsTo
     */
    public function section()
    {
        return $this->belongsTo(\RestaurantCMS\Models\MenuSection::class);
    }
}
