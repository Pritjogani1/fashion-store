<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const STATUS_YES = "yes";
    const STATUS_NO =   "no";
   protected $table = 'roles';
    //
    protected $fillable = ['name' , 'is_super_admin'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function permissions() {
        return $this->belongsToMany(Permission::class, RolePermission::class, "role_id", "permission_id");
    }
}
