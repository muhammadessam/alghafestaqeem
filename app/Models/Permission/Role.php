<?php

namespace App\Models\Permission;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{

    protected $fillable = ['name', 'guard_name','title'];
    protected $appends = ['permissions_ids', 'users_ids','main_permissions', 'date'];

    protected $attributes = [
        'guard_name' => 'web',
    ];

    public function getPermissionsIdsAttribute()
    {
        return $this->permissions->pluck('id')->toArray();
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('id', 'desc');
    }

    //main_permissions
    public function getMainPermissionsAttribute()
    {
        $ids = $this->permissions->pluck('permission_id')->toArray();
        $permissions = Permission::whereIn('id', $ids)->get();
        foreach ($permissions as $permission) {
            $permission->sub = $this->permissions->where('permission_id', $permission->id);
        }
        return $permissions;
    }

    public function getUsersIdsAttribute()
    {
        return !empty($this->users) && count($this->users) > 0
            ? $this->users()
                ->where('active', 1)
                ->pluck('id')
                ->toArray()
            : [];
    }

    public function getDateAttribute()
    {
        return $this->created_at
            ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('m/d/Y')
            : '';
    }

    public function getUpdatedAttribute()
    {
        return $this->updated_at
            ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->updated_at)->format('m/d/Y')
            : '';
    }
}
