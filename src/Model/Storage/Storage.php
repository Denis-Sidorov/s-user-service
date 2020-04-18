<?php

declare(strict_types=1);

namespace App\Model\Storage;

/**
 * Class Storage
 * @package App\Model\Storage
 */
interface Storage
{
    public function save(Model $model): void;
}