<?php

namespace Restaurant\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    // @var string - DB Table name
    protected $table = 'menu_items';

    // @var array - mass-assignable properties
    protected $fillable = ['name', 'priceOne', 'priceTwo', 'sortId', 'description', 'sectionId'];

    /**
     * Belongs to one menu section
     *
     * @return belongsToOne
     */
    public function section()
    {
        return $this->belongsToOne('Restaurant\Models\MenuSection');
    }
}
