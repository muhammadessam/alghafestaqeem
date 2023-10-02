<?php

namespace App\Models\Permission;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoleUser extends Model
{
    use HasFactory;
    protected $table = "model_has_roles";
    protected $fillable = ['role_id', 'model_id'];

    public function role()
    {
        return $this->belongsTo(\App\Models\Permission\Role::class);
    }

    public function model()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
