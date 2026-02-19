<?php

namespace App\Repositories\Interface;

interface RoleRepositoryInterface
{
    public function getAdmin($id);
    public function getAllAdmins();
    public function getPermissions();
    public function getRoles();
    public function getRoleById($id);
    public function updateRole($request, $id);
    public function createRole($request);
    public function deleteRole($request);
    public function getDataForDataTable($request);

}
