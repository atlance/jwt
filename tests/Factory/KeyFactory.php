<?php

declare(strict_types=1);

namespace Atlance\JwtCore\Tests\Factory;

use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Key\InMemory;

final class KeyFactory
{
    /** @param non-empty-string $path */
    public static function create(string $path, string $passphrase = ''): Key
    {
        return InMemory::file($path, $passphrase);
    }
}
