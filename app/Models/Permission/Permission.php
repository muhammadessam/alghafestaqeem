<?php

namespace App\Models\Permission;

use Spatie\Permission\Models\Permission as SpatiePermission;
use App\Models\Permission\Role;
class Permission extends SpatiePermission
{
    protected $fillable = ['name', 'guard_name', 'permission_id', 'parent_id', 'title'];
    protected $with = ['children', 'sub_permissions'];

    protected $attributes = [
        'guard_name' => 'web',
    ];


    protected $appends = ['sub_permissions_types', 'sub_permissions_arr', 'permissions_types'];

    public function sub_permissions()
    {
        return $this->hasMany(self::class, 'permission_id')->orderBy('type', 'asc');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function getRoles()
    {
        return $this->belongsToMany(Role::class, 'role_has_permissions', 'permission_id', 'role_id');
    }

    public function getSubPermissionsTypesAttribute()
    {
        return $this->sub_permissions->pluck('type')->toArray();
    }
    public function getSubPermissionsArrAttribute()
    {
        return $this->sub_permissions->pluck('id', 'type')->toArray();
    }

    public function getPermissionsTypesAttribute()
    {
        $permissions = Permission::whereIn('permission_id', $this->children->pluck('id')->toArray())
            ->orderBy('type', 'asc')
            ->distinct('type')
            ->pluck('type')
            ->toArray();

        return array_unique($permissions);
    }

    public function scopeParent($query)
    {
        return $query->whereNull('parent_id')->whereNull('permission_id');
    }

    public function scopeShow($query)
    {
        return $query->where('permission_id', $this->id)->where('type', 1);
    }

    public function scopeAddRole($query)
    {
        return $query->where('permission_id', $this->id)->where('type', 2);
    }

    public function scopeEdit($query)
    {
        return $query->where('permission_id', $this->id)->where('type', 3);
    }

    public function scopeDeleteRole($query)
    {
        return $query->where('permission_id', $this->id)->where('type', 4);
    }

    public function scopeExport($query)
    {
        return $query->where('permission_id', $this->id)->where('type', 5);
    }

    public function scopeCancel($query)
    {
        return $query->where('permission_id', $this->id)->where('type', 6);
    }

    public function scopePrint($query)
    {
        return $query->where('permission_id', $this->id)->where('type', 7);
    }

    public function scopeCopy($query)
    {
        return $query->where('permission_id', $this->id)->where('type', 8);
    }

    public function scopePaid($query)
    {
        return $query->where('permission_id', $this->id)->where('type', 9);
    }
    public function scopeActive($query)
    {
        return $query->where('permission_id', $this->id)->where('type', 14);
    }

    public function scopeDeActive($query)
    {
        return $query->where('permission_id', $this->id)->where('type', 15);
    }
}