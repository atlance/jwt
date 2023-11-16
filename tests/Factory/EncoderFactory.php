<?php

declare(strict_types=1);

namespace Atlance\JwtCore\Tests\Factory;

use Atlance\JwtCore\Tests\Configuration\Configuration;
use Atlance\JwtCore\Token\Contracts\EncodeInterface;
use Atlance\JwtCore\Token\Factory\TokenFactory;
use Atlance\JwtCore\Token\UseCase\Encode\Handler;

final class EncoderFactory
{
    public static function create(Configuration $configuration): EncodeInterface
    {
        return new Handler(
            new TokenFactory(BuilderFactory::create($configuration)),
            ValidatorFactory::create($configuration)
        );
    }
}
