<?php

namespace App\Repositories;

use App\Models\User;
use App\Interfaces\AdminRepositoryInterface;

class AdminRepository implements AdminRepositoryInterface
{
    public function getAllAdmins()
    {
        return User::all();
    }
    public function getPublishAdmins($page)
    {
        return User::take($page)->get();
    }

    public function getPaginateAdmins($data)
    {
        $items = User::orderBy('id','asc');
        $status = $data['status'] ?? '-1';
        $search = $data['search'] ?? '';
        $from_date = $data['from_date'] ?? '';
        $to_date = $data['to_date'] ?? '';
        if (isset($search) && $search != '') {
            $items = $items->where(
                function ($q) use ($search) {
                    $q->where('id', 'like', '%' . $search . '%');
                    $q->orWhereTranslationLike('title', '%' . $search . '%');
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
        return User::count();
    }

    public function getAdminById($adminId)
    {
        return User::findOrFail($adminId);
    }

    public function deleteAdmin($adminId)
    {
        User::destroy($adminId);
    }

    public function createAdmin($adminDetails)
    {
        return User::create($adminDetails);
    }

    public function updateAdmin($adminId, $newDetails)
    {
        return User::find($adminId)->update($newDetails);
    }
}