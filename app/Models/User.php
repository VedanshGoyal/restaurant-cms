<?php

namespace Restaurant\Models;

use Bican\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Bican\Roles\Traits\HasRoleAndPermission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Str;

class User extends Model implements HasRoleAndPermissionContract, AuthenticatableContract
{
    use Authenticatable, HasRoleAndPermission;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password'];

    /**
     * Generate a create user token and set it to the correct field
     *
     * @param string $field
     * @return bool
     */
    public function generateToken($field)
    {
        $fieldName = $field . 'Token';

        $this->attributes[$fieldName] = Str::random(64);
        return $this->save();
    }

    /**
     * User verify email - set account as active
     *
     * @return void
     */
    public function setActive()
    {
        $this->attributes['createToken'] = null;
        $this->attributes['verified'] = 1;

        $this->save();
    }

    /**
     * Mutator to hash password
     *
     * @param string $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
