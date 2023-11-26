<?php

declare(strict_types=1);

namespace Atlance\JwtCore\Token\Validation;

use Lcobucci\JWT;

final class Validator implements Contracts\ValidatorInterface
{
    /**
     * @var JWT\Validation\Constraint[]
     */
    private readonly array $constraints;

    public function __construct(private readonly JWT\Validator $validator, JWT\Validation\Constraint ...$constraints)
    {
        $this->constraints = $constraints;
    }

    public function assert(JWT\UnencryptedToken $token): void
    {
        $this->validator->assert($token, ...$this->constraints);
    }
}
