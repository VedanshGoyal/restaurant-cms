<?php

namespace RestaurantCMS\Models;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;

class ItemPrice extends Model
{
    use Eloquence, Mappable;

    // @var string - DB table name
    protected $table = 'item_prices';

    // @var array<string> - Mass-assignable fields
    protected $fillable = ['itemId', 'sizeId', 'price'];

    // @var array - Property name maps
    protected $maps = [
        'itemId' => 'item_id',
        'sizeId' => 'size_id',
        'createdAt' => 'created_at',
        'updatedAt' => 'updated_at',
    ];

    // @var array<string> - Fields to be hidden when doing array/json serialization
    protected $hidden = ['item_id', 'size_id', 'created_at', 'updated_at'];

    // @var array<string> - Fields to be added when doing array/json serialization
    protected $appends = ['itemId', 'sizeId', 'createdAt', 'updatedAt'];

    /**
     * Belongs-to MenuItem
     *
     * @return BelongsTo
     */
    public function menuItem()
    {
        return $this->belongsTo(RestaurantCMS\Models\MenuItem::class);
    }

    /**
     * Belongs-to SectionSize
     *
     * @return BelongsTo
     */
    public function sectionSize()
    {
        return $this->belongsTo(RestaurantCMS\Models\SectionSize::class);
    }
}
