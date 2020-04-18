<?php

declare(strict_types=1);

namespace App\Dto;

use DateTime;
use DateTimeImmutable;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use function date;

/**
 * Class UserDto
 * @package App\Model\User
 */
class UserDto
{
    private ?string $id = null;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min="1",
     *     max="50"
     * )
     */
    private ?string $name = null;

    private ?DateTimeImmutable $birthday = null;

    /**
     * @Assert\Choice(choices={
     *      \App\Model\User\Gender::MALE,
     *      \App\Model\User\Gender::FEMALE,
     * })
     */
    private ?string $gender = null;

    /**
     * @Assert\Length(
     *     min="2",
     *     max="500",
     *     allowEmptyString=true
     * )
     */
    private ?string $address = null;

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     * @return UserDto
     */
    public function setId(?string $id): UserDto
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return UserDto
     */
    public function setName(?string $name): UserDto
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
     * @return UserDto
     */
    public function setBirthday(?DateTimeImmutable $birthday): UserDto
    {
        $this->birthday = $birthday;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * @param string|null $gender
     * @return UserDto
     */
    public function setGender(?string $gender): UserDto
    {
        $this->gender = $gender;
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
     * @return UserDto
     */
    public function setAddress(?string $address): UserDto
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @Assert\Callback()
     */
    public function validateBirthday(ExecutionContextInterface $context, $payload): void
    {
        if (!$this->birthday instanceof DateTimeImmutable) {
            return;
        }

        $minDate = (new DateTime())->setDate((int)date('Y') - 120, 1, 1);
        $maxDate = (new DateTime())->setDate((int)date('Y') - 20, 12, 31);
        $tooOld = $this->birthday < $minDate;
        $tooYoung = $this->birthday > $maxDate;
        if ($tooOld || $tooYoung) {
            $context
                ->buildViolation('The birthday is too ' . ($tooYoung ? 'small' : 'big'))
                ->atPath('birthday')
                ->addViolation();
        }
    }
}