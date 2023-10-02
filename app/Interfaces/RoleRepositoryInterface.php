<?php

namespace App\Interfaces;

interface RoleRepositoryInterface
{
    public function getAllRoles();
    public function getPublishRoles( $page, $list);
    public function getPublishRolesByIds($ids ,$page, $list);
    public function getPaginateRoles($data);
    public function getRoleById($roleId);
    public function deleteRole($roleId);
    public function createRole($roleDetails);
    public function updateRole($roleId, $newDetails);
    public function getRoleBySlug($roleSlug);
    public function getCount();
}