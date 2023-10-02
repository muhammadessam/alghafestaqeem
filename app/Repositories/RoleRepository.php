<?php

namespace App\Repositories;

use Illuminate\Support\Str;
use App\Models\Permission\Role;
use App\Interfaces\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface
{
    public function getAllRoles()
    {
        return Role::get();
    }

    public function getPublishRoles( $page, $list = 'paginate')
    {
        $data = Role::Recent();
        if ($list == 'list') {
            $data = $data->take($page)->get();
        } elseif ($list == 'all') {
            $data = $data->get();
        } else {
            $data = $data->paginate($page);
        }
        return $data;
    }



    public function getPublishRolesByIds($ids ,$page, $list = 'paginate')
    {
        $data = Role::whereIn('id', $ids)->Recent();
        if ($list == 'list') {
            $data = $data->take($page)->get();
        } elseif ($list == 'all') {
            $data = $data->get();
        } else {
            $data = $data->paginate($page);
        }
        return $data;
    }

    public function getPaginateRoles($data)
    {
        $items = Role::Recent();
        $status = $data['status'] ?? '-1';
        $search = $data['search'] ?? '';
        $from_date = $data['from_date'] ?? '';
        $to_date = $data['to_date'] ?? '';
        $role = $data['Role'] ?? '';
        if (isset($search) && $search != '') {
            $items = $items->where(
                function ($q) use ($search) {
                    $q->where('id', 'like', '%' . $search . '%');
                    $q->orWhere('title', 'like', '%' . $search . '%');
                }
            );
        }
        if (isset($from_date) && $from_date != '') {
            $items = $items->whereDate('created_at', '>=', $from_date);
        }
        if (isset($to_date) && $to_date != '') {
            $items = $items->whereDate('created_at', '<=', $to_date);
        }
        if (isset($status) && $status != '-1') {
            $items = $items->where('active', $status);
        }

        $items = $items->paginate(25);

        return $items;
    }

    public function getCount()
    {
        return Role::count();
    }

    public function getRoleById($roleId)
    {
        return Role::findOrFail($roleId);
    }

    public function getRoleBySlug($roleSlug)
    {
        return Role::where('slug', $roleSlug)->first();
    }

    public function deleteRole($roleId)
    {
        Role::destroy($roleId);
    }

    public function createRole($roleDetails)
    {
        return Role::create($roleDetails);
    }

    public function updateRole($roleId, $newDetails)
    {
        return Role::find($roleId)->update($newDetails);
    }
}