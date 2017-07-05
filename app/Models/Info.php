<?php

namespace RestaurantCMS\Models;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    // @var string - DB table name
    protected $table = 'info';

    // @var array<string> - Mass-assignable fields
    protected $fillable = ['name', 'street', 'city', 'state', 'zip'];

    // @var array<string> - Fields to be hidden when doing array/json serialization
    protected $hidden = ['created_at', 'updated_at', 'id'];

    /**
     * Has-many PhoneNumber
     *
     * @return HasMany
     */
    public function phoneNumbers()
    {
        return $this->hasMany(\RestaurantCMS\Models\PhoneNumber::class);
    }
}
