<?php

namespace RestaurantCMS\Models;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;

class PhoneNumber extends Model
{
    use Eloquence, Mappable;

    // @var string - DB table name
    protected $table = 'phone_numbers';

    // @var array<string> - Mass-assignable fields
    protected $fillable = ['infoId', 'phoneNumber'];

    // @var array - Property name mapskk
    protected $maps = [
        'infoId' => 'info_id',
        'phoneNumber' => 'phone_number',
    ];

    // @var array<string> - Fields to be hidden when doing array/json serialization
    protected $hidden = ['phone_number', 'info_id'];

    // @var array<string> - Fields to be added when doing array/json serialization
    protected $appends = ['infoId', 'phoneNumber'];

    /**
     * Belongs-to Info
     *
     * @return BelongsTo
     */
    public function info()
    {
        return $this->belongsTo(\RestaurantCMS\Models\Info::class);
    }
}
