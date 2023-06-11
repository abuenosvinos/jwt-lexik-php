<?php

declare(strict_types=1);

namespace Abuenosvinos\Infrastructure\Jwt;

use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;

final class Encrypt
{
    public function __construct(private JWTEncoderInterface $encoder)
    {
    }

    public function encrypt(array $payload): string
    {
        return $this->encoder->encode($payload);
    }
}
