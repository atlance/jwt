<?php

declare(strict_types=1);

namespace Atlance\JwtCore\Token\UseCase\Encode;

use Atlance\JwtCore\Token\Contracts\DataSet\DataSetInterface;
use Atlance\JwtCore\Token\Contracts\EncodeInterface;
use Atlance\JwtCore\Token\Contracts\Factory\TokenFactoryInterface;
use Atlance\JwtCore\Token\Validation\Contracts\ValidatorInterface;

final class Handler implements EncodeInterface
{
    private TokenFactoryInterface $factory;
    private ValidatorInterface $validator;

    public function __construct(TokenFactoryInterface $factory, ValidatorInterface $validator)
    {
        $this->factory = $factory;
        $this->validator = $validator;
    }

    public function encode(DataSetInterface $dataSet): string
    {
        $token = $this->factory->create($dataSet);
        $this->validator->assert($token);

        return $token->toString();
    }
}
