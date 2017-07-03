<?php

namespace RestaurantCMS;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;

class SectionSize extends Model
{
    use Eloquence, Mappable;

    // @var string - DB table name
    protected $table = 'section_sizes';

    // @var array<string> - Mass-assignable fields
    protected $fillable = ['sectionId', 'sortId', 'label'];

    // @var array - Property name mapskk
    protected $maps = [
        'sectionId' => 'section_id',
        'sort_id' => 'sort_id',
    ];

    // @var array<string> - Fields to be hidden when doing array/json serialization
    protected $hidden = ['sort_id', 'section_id', 'created_at', 'updated_at'];

    // @var array<string> - Fields to be added when doing array/json serialization
    protected $appends = ['sectionId', 'sortId'];

    /**
     * Belongs-to MenuSection
     *
     * @return BelongsTo
     */
    public function section()
    {
        return $this->belongsTo(RestaurantCMS\Models\MenuSection::class);
    }
}
