<?php

declare(strict_types=1);

namespace Atlance\JwtCore\Tests\Factory;

use Atlance\JwtCore\Tests\Configuration\Configuration;
use Atlance\JwtCore\Token\Builder;
use Atlance\JwtCore\Token\Contracts\Builder\Decorator\JWTBuilderInterface;
use Atlance\JwtCore\Token\Factory\SignerResolver;
use Lcobucci\Clock\SystemClock;
use Lcobucci\JWT;

final class BuilderFactory
{
    public static function create(Configuration $configuration): JWTBuilderInterface
    {
        return new Builder(
            new JWT\Builder(),
            SignerResolver::resolve($configuration->openssl->algorithm_id),
            JWT\Signer\Key\InMemory::file(
                $configuration->openssl->private_key,
                $configuration->openssl->private_passphrase
            ),
            SystemClock::fromSystemTimezone(),
            $configuration->jwt->options->ttl
        );
    }
}
