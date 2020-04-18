<?php

declare(strict_types=1);

namespace App\DataTransformer;

use App\Dto\UserDto;
use App\Model\User\Gender;
use App\Model\User\User;

/**
 * Class UserTransformer
 * @package App\DataTransformer
 */
class UserTransformer
{
    public function toDto(User $user): UserDto
    {
        return (new UserDto())
            ->setName($user->getName())
            ->setBirthday($user->getBirthday())
            ->setGender((string)$user->getGender())
            ->setAddress($user->getAddress());
    }

    public function fromDto(UserDto $dto): User
    {
        return (new User($dto->getName()))
            ->setBirthday($dto->getBirthday())
            ->setGender(new Gender($dto->getGender()))
            ->setAddress($dto->getAddress());
    }
}