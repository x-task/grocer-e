<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /* Relationship of the permissions for Roles */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /* Relatiship of the users for Roles */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
