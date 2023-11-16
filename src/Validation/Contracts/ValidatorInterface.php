<?php

declare(strict_types=1);

namespace Atlance\JwtCore\Token\Validation\Contracts;

use Lcobucci\JWT;

interface ValidatorInterface
{
    public function assert(JWT\UnencryptedToken $token): void;
}
