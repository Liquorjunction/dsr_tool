<?php

namespace App\Repositories\Interface;

interface UserRepositoryInterface
{
    public function findById($id);
    public function findByEmail($email);
    public function createAdminUser($request);
    public function updateAdminUser($request, $id);
    public function updateSelfProfile($request, $id);
    public function deleteAdminUser($id);
    public function toggleAdminUserStatus($id);
    public function getAllAdminUsers();
    public function getAdminUserById($id);
    public function getDataforDataTable($request);
}
