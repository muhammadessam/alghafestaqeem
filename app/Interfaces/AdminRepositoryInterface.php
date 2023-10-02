<?php

namespace App\Interfaces;

interface AdminRepositoryInterface
{
    public function getAllAdmins();
    public function getPublishAdmins($page);
    public function getPaginateAdmins($data);
    public function getAdminById($adminId);
    public function deleteAdmin($adminId);
    public function createAdmin($adminDetails);
    public function updateAdmin($adminId, $newDetails);
    public function getCount();
}