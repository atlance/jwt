<?php

declare(strict_types=1);

namespace Atlance\JwtCore\Tests\Factory;

use Atlance\JwtCore\Token\Factory\SignerResolver;
use Lcobucci\JWT\Signer;

final class SignerFactory
{
    public static function create(string $algorithmId): Signer
    {
        return SignerResolver::resolve($algorithmId);
    }
}
