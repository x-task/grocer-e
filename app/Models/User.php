<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Post;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'avatar',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /* Encrypting password with Mutator */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function getAvatarAttribute($value)
    {
            if (strpos($value, 'https://') !== false || strpos($value, 'http://') !== false)
            {
                return $value;
            }

        return asset('images/' . $value);
    }

    /* Relationship of posts for Users */
    public function posts(){

        return $this->hasMany(Post::class);

    }

    /* Relationship of permissions for Users */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /* Relationship of roles for Users */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /* Function that lets only Admins see the Dashboard page */
    public function userHasRole($role_name)
    {
        foreach ($this->roles as $role) {
            if ($role_name == $role->label) {
                return true;
            }
            return false;
        }
    }
}


