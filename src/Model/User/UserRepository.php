<?php

declare(strict_types=1);

namespace App\Model\User;

/**
 * Class UserRepository
 * @package App\Model\User
 */
interface UserRepository
{
    public function save(User $user): void;
}