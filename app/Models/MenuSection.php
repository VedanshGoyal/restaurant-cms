<?php

namespace Restaurant\Models;

use Illuminate\Database\Eloquent\Model;

class MenuSection extends Model
{
    // Database table name
    protected $table = 'menu_sections';

    // Mass-assignable properties
    protected $fillable = ['name', 'item_prices', 'sort_id'];

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
