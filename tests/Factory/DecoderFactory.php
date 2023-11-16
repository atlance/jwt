<?php

declare(strict_types=1);

namespace Atlance\JwtCore\Tests\Factory;

use Atlance\JwtCore\Tests\Configuration\Configuration;
use Atlance\JwtCore\Token\Contracts\DecodeInterface;
use Atlance\JwtCore\Token\UseCase\Decode\Handler;
use Lcobucci\JWT\Parser;

final class DecoderFactory
{
    public static function create(Configuration $configuration): DecodeInterface
    {
        return new Handler(new Parser(), ValidatorFactory::create($configuration));
    }
}
