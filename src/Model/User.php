<?php

declare(strict_types=1);

namespace App\Model;

use DateTime;
use InvalidArgumentException;

/**
 * Class User
 * @package App\Model
 */
class User
{
    private string $name;
    private ?DateTime $birthDate;
    private ?string $address;
    private ?Gender $gender;

    /**
     * User constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        if (empty($name)) {
            throw new InvalidArgumentException("Empty name");
        }

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
     * @return DateTime|null
     */
    public function getBirthDate(): ?DateTime
    {
        return $this->birthDate;
    }

    /**
     * @param DateTime|null $birthDate
     * @return User
     */
    public function setBirthDate(?DateTime $birthDate): User
    {
        $this->birthDate = $birthDate;
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