<?php

declare(strict_types=1);

namespace App\Exception;

use Exception;

class NullIdentityException extends Exception
{
    public function __construct()
    {
        parent::__construct("Model's identity is null");
    }
}