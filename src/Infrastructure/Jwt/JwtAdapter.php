<?php

declare(strict_types=1);

namespace Abuenosvinos\Infrastructure\Jwt;

use Abuenosvinos\Domain\Adapter\Jwt\JwtAdapter as JwtDomainAdapter;

class JwtAdapter implements JwtDomainAdapter
{
    public function __construct(private Encrypt $encryptor, private Decrypt $decryptor)
    {
    }

    public function encrypt(array $payload): string
    {
        return $this->encryptor->encrypt($payload);
    }

    public function decrypt(string $token): array
    {
        return $this->decryptor->decrypt($token);
    }
}
