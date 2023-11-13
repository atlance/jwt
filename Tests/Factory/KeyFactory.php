<?php

declare(strict_types=1);

namespace Atlance\JwtCore\Tests\Factory;

use Lcobucci\JWT;

final class KeyFactory
{
    public static function create(string $path, string $passphrase = ''): JWT\Signer\Key
    {
        return JWT\Signer\Key\InMemory::file($path, $passphrase);
    }
}
