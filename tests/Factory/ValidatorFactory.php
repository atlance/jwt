<?php

declare(strict_types=1);

namespace Atlance\JwtCore\Tests\Factory;

use Atlance\JwtCore\Tests\Configuration\Configuration;
use Atlance\JwtCore\Token\Validation\Constraint\HasClaim;
use Atlance\JwtCore\Token\Validation\Contracts\ValidatorInterface;
use Atlance\JwtCore\Token\Validation\Validator;
use Lcobucci\Clock\SystemClock;
use Lcobucci\JWT;
use Lcobucci\JWT\Validation\Constraint;

final class ValidatorFactory
{
    public static function create(Configuration $configuration): ValidatorInterface
    {
        return new Validator(
            new JWT\Validation\Validator(),
            new Constraint\SignedWith(
                SignerFactory::create($configuration->openssl->algorithm_id),
                KeyFactory::create(
                    $configuration->openssl->private_key,
                    $configuration->openssl->private_passphrase
                )
            ),
            new Constraint\StrictValidAt(SystemClock::fromSystemTimezone()),
            new HasClaim($configuration->jwt->claims->client_claim_name)
        );
    }
}
