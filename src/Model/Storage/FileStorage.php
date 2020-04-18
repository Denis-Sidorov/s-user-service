<?php

declare(strict_types=1);

namespace App\Model\Storage;

use App\Exception\NullIdentityException;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Serializer\SerializerInterface;
use function array_pop;
use function explode;
use function get_class;
use function is_null;
use function mb_strtolower;
use const DIRECTORY_SEPARATOR;

/**
 * Class FileStorage
 * @package App\Model\Storage
 */
class FileStorage implements Storage
{
    private string $path;

    private Filesystem $fs;

    private SerializerInterface $serializer;

    /**
     * FileStorage constructor.
     * @param string $path
     * @param Filesystem $fs
     * @param SerializerInterface $serializer
     */
    public function __construct(string $path, Filesystem $fs, SerializerInterface $serializer)
    {
        $this->path = $path;
        $this->fs = $fs;
        $this->serializer = $serializer;
    }

    /**
     * @throws NullIdentityException
     */
    public function save(Model $model): void
    {
        if (is_null($model->getId())) {
            throw new NullIdentityException();
        }

        $dataPath = $this->path
            . DIRECTORY_SEPARATOR
            . $this->getModelName($model)
            . DIRECTORY_SEPARATOR
            . $model->getId() . '.json';
        $this->fs->dumpFile($dataPath, $this->serializer->serialize($model, 'json'));
    }

    private function getModelName(object $model): string
    {
        $classNameParts = explode('\\', get_class($model));
        return mb_strtolower(array_pop($classNameParts));
    }
}