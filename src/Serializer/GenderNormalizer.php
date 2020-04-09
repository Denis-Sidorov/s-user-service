<?php

declare(strict_types=1);

namespace App\Serializer;

use App\Model\Gender;
use Symfony\Component\Serializer\Exception\BadMethodCallException;
use Symfony\Component\Serializer\Exception\CircularReferenceException;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Exception\ExtraAttributesException;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\LogicException;
use Symfony\Component\Serializer\Exception\RuntimeException;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Class GenderDenormalizer
 * @package App\Serializer
 */
class GenderNormalizer implements NormalizerInterface, DenormalizerInterface
{
    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        try {
            return new Gender($data);
        } catch (\InvalidArgumentException $e) {
            throw new UnexpectedValueException("Unexpected value for gender", $e->getCode(), $e);
        }
    }

    public function supportsDenormalization($data, string $type, string $format = null)
    {
        return $type === Gender::class;
    }

    public function normalize($object, string $format = null, array $context = [])
    {
        return (string)$object;
    }

    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof Gender;
    }
}