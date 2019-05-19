<?php

namespace App\Decorator;


use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class SwaggerDecorator implements NormalizerInterface
{
    private $decorated;

    public function __construct(NormalizerInterface $decorated)
    {
        $this->decorated = $decorated;
    }

    /**
     * @param $object
     * @param null $format
     * @param array $context
     * @return array|bool|float|int|string
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    public function normalize($object, $format = null, array $context = [])
    {
        $docs = $this->decorated->normalize($object, $format, $context);

        $docs['paths']['/api/check']['get']['responses'][200] = [
            'description' => 'All is well',
        ];

        return $docs;
    }

    public function supportsNormalization($data, $format = null)
    {
        return $this->decorated->supportsNormalization($data, $format);
    }
}
