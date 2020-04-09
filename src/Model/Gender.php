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

    private string $type;

    /**
     * Gender constructor.
     * @param string $type
     */
    function __construct(string $type)
    {
        if (!in_array($type, [self::MALE, self::FEMALE], true)) {
            throw new InvalidArgumentException('Invalid gender type');
        }

        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    public function __toString()
    {
        return $this->type;
    }
}