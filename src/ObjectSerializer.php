<?php

namespace Pennylane\Sdk;

use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AttributeLoader;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class ObjectSerializer
{
    private SerializerInterface $serializer;

    public function __construct()
    {
        $classMetadataFactory = new ClassMetadataFactory(new AttributeLoader());
        $normalizers = [
            new DateTimeNormalizer(['datetime_format' => 'Y-m-d']),
            new ArrayDenormalizer(),
            new ObjectNormalizer($classMetadataFactory, new CamelCaseToSnakeCaseNameConverter(), null, new ReflectionExtractor()),
        ];
        $encoders = [new JsonEncoder()];

        $this->serializer = new Serializer($normalizers, $encoders);
    }

    public function serialize(mixed $data, array $groups)
    {
        if (is_array($data)) {
            $data = json_encode($data);
        }

        return $this->serializer->serialize($data, 'json', ['groups' => $groups]);
    }

    public function deserialize(string|array $data, string $type, array $groups)
    {
        if (is_array($data)) {
            $data = json_encode($data);
        }

        return $this->serializer->deserialize($data, $type, 'json', [
            'groups' => $groups,
            DateTimeNormalizer::FORMAT_KEY => 'Y-m-d',
        ]);
    }
}
