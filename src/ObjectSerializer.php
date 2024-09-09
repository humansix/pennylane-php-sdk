<?php

namespace Pennylane\Sdk;

use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Loader\AttributeLoader;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Serializer\Serializer;

class ObjectSerializer
{

    private SerializerInterface $serializer;

    public function __construct()
    {
        $normalizers = [new DateTimeNormalizer(), new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter())];
        $encoders = [new JsonEncoder()];

        $this->serializer = new Serializer($normalizers, $encoders);
    }

    public function serialize(mixed $data)
    {
        if (is_array($data)) {
            $data = json_encode($data);
        }

        return $this->serializer->serialize($data, 'json');
    }

    public function deserialize(string|array $data, string $type)
    {
        if (is_array($data)) {
            $data = json_encode($data);
        }

        return $this->serializer->deserialize($data, $type, 'json');
    }
}