<?php

namespace Restaurant\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    // Database table name
    protected $table = 'menu_items';

    // Mass-assignable properties
    protected $fillable = ['name', 'price_one', 'price_two', 'sort_id', 'tags', 'description'];

    public function menuSection()
    {
            return $this->belongsToOne('MenuSection');
    }
}
