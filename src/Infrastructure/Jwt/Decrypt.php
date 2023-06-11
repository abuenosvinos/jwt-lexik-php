<?php

declare(strict_types=1);

namespace Abuenosvinos\Infrastructure\Jwt;

use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;

final class Decrypt
{
    public function __construct(private JWTEncoderInterface $encoder)
    {
    }

    public function decrypt(string $token): array
    {
        return $this->encoder->decode($token);
    }
}
