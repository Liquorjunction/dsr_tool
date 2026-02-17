<?php

namespace App\Repositories\Interface;

interface AdminRepositoryInterface
{
    public function authenticate(string $login, string $password, bool $remember = false): bool;
    public function logout(): void;
}
