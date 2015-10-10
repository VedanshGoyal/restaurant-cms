<?php

namespace Restaurant\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    // @var string - DB Table name
    protected $table = 'menu_items';

    // @var array - mass-assignable properties
    protected $fillable = ['name', 'priceOne', 'priceTwo', 'sortId', 'tags', 'description', 'section_id'];

    /**
     * Belongs to one menu section
     *
     * @return belongsToOne
     */
    public function section()
    {
        return $this->belongsToOne('Restaurant\Models\MenuSection');
    }

    /**
     * Mutator to set tags as serialized string
     *
     * @param array $value
     * @return void
     */
    public function setTagsAttrbiute(array $value = [])
    {
        $this->attributes['tags'] = serialize($value);
    }

    /**
     * Accessor to get tags from serialized string
     *
     * @param string $value
     * @return array
     */
    public function getTagsAttribute($value)
    {
        return unserialize($value);
    }
}
