<?php

declare(strict_types=1);

namespace App\Model\User;

use App\Model\Storage\Model;
use DateTimeImmutable;
use InvalidArgumentException;

/**
 * Class User
 * @package App\Model
 */
class User extends Model
{
    private string $name;
    private ?DateTimeImmutable $birthday = null;
    private ?string $address = null;
    private ?Gender $gender = null;

    /**
     * User constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        if (empty($name)) {
            throw new InvalidArgumentException("Empty name");
        }

        parent::__construct();
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return User
     */
    public function setName(string $name): User
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getBirthday(): ?DateTimeImmutable
    {
        return $this->birthday;
    }

    /**
     * @param DateTimeImmutable|null $birthday
     * @return User
     */
    public function setBirthday(?DateTimeImmutable $birthday): User
    {
        $this->birthday = $birthday;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     * @return User
     */
    public function setAddress(?string $address): User
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return Gender|null
     */
    public function getGender(): ?Gender
    {
        return $this->gender;
    }

    /**
     * @param Gender|null $gender
     * @return User
     */
    public function setGender(?Gender $gender): User
    {
        $this->gender = $gender;
        return $this;
    }
}