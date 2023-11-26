<?php

declare(strict_types=1);

namespace Atlance\JwtCore\Token\Factory;

use Atlance\JwtCore\Token\Contracts\Builder\Decorator\JWTBuilderInterface;
use Atlance\JwtCore\Token\Contracts\DataSet\DataSetInterface;
use Atlance\JwtCore\Token\Contracts\Factory\TokenFactoryInterface;
use Lcobucci\JWT;

final class TokenFactory implements TokenFactoryInterface
{
    public function __construct(private readonly JWTBuilderInterface $builder)
    {
    }

    public function create(DataSetInterface $dataSet): JWT\UnencryptedToken
    {
        return $this->builder
            ->issuedBy($dataSet->iss())
            ->relatedTo($dataSet->sub())
            ->permittedFor(...$dataSet->aud())
            ->expiresAt($dataSet->exp())
            ->canOnlyBeUsedAfter($dataSet->nbf())
            ->issuedAt($dataSet->iat())
            ->identifiedBy($dataSet->jti())
            ->withClaims($dataSet->claims())
            ->withHeaders($dataSet->headers())
            ->getToken();
    }
}
