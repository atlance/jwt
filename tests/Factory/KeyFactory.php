<?php

declare(strict_types=1);

namespace Atlance\JwtCore\Tests\Factory;

use Lcobucci\JWT;
use Lcobucci\JWT\Signer\Key;

final class KeyFactory
{
    /**
     * @param non-empty-string $path
     *
     * @return Key
     */
    public static function create(string $path, string $passphrase = ''): JWT\Signer\Key
    {
        return JWT\Signer\Key\InMemory::file($path, $passphrase);
    }
}
