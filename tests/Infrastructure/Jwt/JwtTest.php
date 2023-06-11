<?php

declare(strict_types=1);

namespace Abuenosvinos\Tests\Infrastructure\Jwt;

use Abuenosvinos\Infrastructure\Jwt\JwtAdapter;
use Abuenosvinos\Domain\Adapter\Jwt\JwtDecryptException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class JwtTest extends KernelTestCase
{
    public function testEncryption()
    {
        $payload = [
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => [
                'subkey1' => 'value3'
            ]
        ];

        /** @var JwtAdapter $encoder */
        $encoder = $this->getContainer()->get(JwtAdapter::class);

        $token = $encoder->encrypt($payload);
        $this->assertIsString($token);

        $payloadBack = $encoder->decrypt($token);
        unset($payloadBack['exp'], $payloadBack['iat']); // Fields from lexik plugin
        $this->assertEquals($payloadBack, $payload);
    }

    public function xtestDifferentJwtKey(): void
    {
        $this->expectException(JwtDecryptException::class);

        /** @var JwtAdapter $encoder */
        $encoder = $this->getContainer()->get(JwtAdapter::class);
/*
        $encoder = new JwtAdapter(
            new Encrypt(),
            new Decrypt()
        );
*/
        $token = $encoder->encrypt([]);
        $this->assertIsString($token);

        $encoder->decrypt($token);
    }
}
