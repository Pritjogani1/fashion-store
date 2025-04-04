<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    public $fillable = [
        "role_id",
        "permission_id"
    ];
}
