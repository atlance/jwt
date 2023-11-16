<?php

declare(strict_types=1);

namespace Atlance\JwtCore\Token\UseCase\Decode;

use Atlance\JwtCore\Token\Contracts\DataSet\DataSetInterface;
use Atlance\JwtCore\Token\Contracts\DecodeInterface;
use Atlance\JwtCore\Token\Factory\DataSetFactory;
use Atlance\JwtCore\Token\Validation\Contracts\ValidatorInterface;
use Lcobucci\JWT;

final class Handler implements DecodeInterface
{
    public function __construct(private readonly JWT\Parser $parser, private readonly ValidatorInterface $validator)
    {
    }

    /**
     * {@inheritdoc}
     *
     * @psalm-suppress ArgumentTypeCoercion
     * @psalm-suppress MixedArgumentTypeCoercion
     *
     * @throws JWT\Encoding\CannotDecodeContent           when something goes wrong while decoding
     * @throws JWT\Token\InvalidTokenStructure            when token string structure is invalid
     * @throws JWT\Token\UnsupportedHeaderFound           when parsed token has an unsupported header
     * @throws JWT\Validation\RequiredConstraintsViolated
     * @throws JWT\Validation\NoConstraintsGiven
     */
    public function decode(string $value): DataSetInterface
    {
        $token = $this->parser->parse($value);
        \assert($token instanceof JWT\UnencryptedToken);

        $this->validator->assert($token);

        return DataSetFactory::fromJWT($token);
    }
}
