<?php

namespace RestaurantCMS\Models;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;

class MenuSection extends Model
{
    use Eloquence, Mappable;

    // @var string - DB table name
    protected $table = 'menu_sections';

    // @var array<string> - Mass-assignable fields
    protected $fillable = ['sortId', 'name'];

    // @var array - Property name mapskk
    protected $maps = [
        'sortId' => 'sort_id',
        'createdAt' => 'created_at',
        'updatedAt' => 'updated_at',
    ];

    // @var array<string> - Fields to be hidden when doing array/json serialization
    protected $hidden = ['sort_id', 'created_at', 'updated_at'];

    // @var array<string> - Fields to be added when doing array/json serialization
    protected $appends = ['sortId', 'createdAt', 'updatedAt'];

    /**
     * Has-many MenuItem
     *
     * @return HasMany
     */
    public function items()
    {
        return $this->hasMany(\RestaurantCMS\Models\MenuItem::class, 'section_id');
    }

    /**
     * Has-many SectionSize
     *
     * @return HasMany
     */
    public function sizes()
    {
        return $this->hasMany(\RestaurantCMS\Models\SectionSize::class, 'section_id');
    }
}
