<?php

declare(strict_types=1);

namespace App\Model\Storage;

use Ramsey\Uuid\Uuid;

/**
 * Class Model
 * @package App\Model\Storage
 */
abstract class Model
{
    private ?string $id;

    public function __construct()
    {
        $this->setId((string)Uuid::uuid4());
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     * @return $this
     */
    public function setId(?string $id)
    {
        $this->id = $id;
        return $this;
    }
}