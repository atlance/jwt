<?php

declare(strict_types=1);

namespace Atlance\JwtCore\Token\Validation;

use Lcobucci\JWT;

final class Validator implements Contracts\ValidatorInterface
{
    private JWT\Validator $validator;

    /**
     * @var JWT\Validation\Constraint[]
     */
    private array $constraints;

    public function __construct(JWT\Validator $validator, JWT\Validation\Constraint ...$constraints)
    {
        $this->validator = $validator;
        $this->constraints = $constraints;
    }

    public function assert(JWT\Token $token): void
    {
        $this->validator->assert($token, ...$this->constraints);
    }
}
