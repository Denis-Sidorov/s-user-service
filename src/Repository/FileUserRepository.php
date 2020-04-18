<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\Storage\Storage;
use App\Model\User\User;
use App\Model\User\UserRepository;

class FileUserRepository implements UserRepository
{
    private Storage $storage;

    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
    }

    public function save(User $user): void
    {
        $this->storage->save($user);
    }
}