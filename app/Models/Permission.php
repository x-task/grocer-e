<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $guarded = [];

    /* Relationship of the roles for Permissions */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /* Relationship of the users for Permissions */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
