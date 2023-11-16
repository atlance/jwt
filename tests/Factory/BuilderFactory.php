<?php

declare(strict_types=1);

namespace Atlance\JwtCore\Tests\Factory;

use Atlance\JwtCore\Tests\Configuration\Configuration;
use Atlance\JwtCore\Token\Builder;
use Atlance\JwtCore\Token\Contracts\Builder\Decorator\JWTBuilderInterface;
use Atlance\JwtCore\Token\Factory\SignerResolver;
use Lcobucci\JWT;
use Lcobucci\JWT\Encoding\ChainedFormatter;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Symfony\Component\Clock\Clock;

final class BuilderFactory
{
    public static function create(Configuration $configuration): JWTBuilderInterface
    {
        return new Builder(
            new JWT\Token\Builder(new JoseEncoder(), ChainedFormatter::withUnixTimestampDates()),
            SignerResolver::resolve($configuration->openssl->algorithm_id),
            JWT\Signer\Key\InMemory::file(
                $configuration->openssl->private_key,
                $configuration->openssl->private_passphrase
            ),
            new Clock(),
            $configuration->jwt->options->ttl
        );
    }
}
