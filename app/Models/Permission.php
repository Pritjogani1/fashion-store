<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public $fillable = [
        "name",
        "key",
    ];

    public function roles() {
        return $this->belongsToMany(Role::class, RolePermission::class, "permission_id", "role_id");
    }
}
