<?php

declare(strict_types=1);

namespace App\Model;

use InvalidArgumentException;
use function in_array;

/**
 * Class Gender
 * @package App\Model
 */
class Gender
{
    const MALE = 'male';
    const FEMALE = 'female';

    private string $name;

    /**
     * Gender constructor.
     * @param string $name
     */
    function __construct(string $name)
    {
        if (!in_array($name, [self::MALE, self::FEMALE], true)) {
            throw new InvalidArgumentException('Invalid gender type');
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

    public function __toString()
    {
        return $this->name;
    }
}