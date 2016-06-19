<?php

namespace Restaurant\Models;

use Illuminate\Database\Eloquent\Model;

class SiteConfig extends Model
{
    // @var string - DB Table name
    protected $table = 'site_config';

    // @var array - mass-assignable properties
    protected $fillable = ['allow_reg'];
}
