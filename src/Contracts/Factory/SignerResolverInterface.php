<?php

declare(strict_types=1);

namespace Atlance\JwtCore\Token\Contracts\Factory;

use Lcobucci\JWT\Signer as SignerInterface;

interface SignerResolverInterface
{
    public static function resolve(string $algorithmId): SignerInterface;
}
