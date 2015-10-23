<?php

namespace Restaurant\Models;

use Illuminate\Database\Eloquent\Model;

class MenuSection extends Model
{
    // @var string - DB Table name
    protected $table = 'menu_sections';

    // @var array - mass-assignable properties
    protected $fillable = ['name', 'itemPrices', 'sortId', 'infoTitle', 'info'];

    /**
     * Has many menu item models
     *
     * @return HasMany
     */
    public function items()
    {
        return $this->hasMany('Restaurant\Models\MenuItem', 'section_id');
    }
}
