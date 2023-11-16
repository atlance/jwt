<?php

declare(strict_types=1);

namespace Atlance\JwtCore\Tests\Factory;

use Atlance\JwtCore\Tests\Configuration\Configuration;
use Atlance\JwtCore\Token\Contracts\DecodeInterface;
use Atlance\JwtCore\Token\UseCase\Decode\Handler;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Token\Parser;

final class DecoderFactory
{
    public static function create(Configuration $configuration): DecodeInterface
    {
        return new Handler(new Parser(new JoseEncoder()), ValidatorFactory::create($configuration));
    }
}
