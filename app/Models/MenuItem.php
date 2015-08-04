<?php

namespace Restaurant\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    // Database table name
    protected $table = 'menu_items';

    // Mass-assignable properties
    protected $fillable = ['name', 'priceOne', 'priceTwo', 'sortId', 'tags', 'description', 'section_id'];

    /**
     * Belongs to one menu section
     *
     * @return belongsToOne
     */
    public function menuSection()
    {
            return $this->belongsToOne('MenuSection');
    }
}
