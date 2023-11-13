<?php

declare(strict_types=1);

namespace Atlance\JwtCore\Token;

use Atlance\JwtCore\Token\Contracts\Builder\Decorator\JWTBuilderInterface;
use Lcobucci\Clock\Clock;
use Lcobucci\JWT;

final class Builder implements JWTBuilderInterface
{
    public const TTL = 3600;

    private JWT\Builder $tokenBuilder;
    private JWT\Signer $signer;
    private JWT\Signer\Key $key;
    private Clock $clock;
    private int $ttl;

    public function __construct(
        JWT\Builder $tokenBuilder,
        JWT\Signer $signer,
        JWT\Signer\Key $key,
        Clock $clock,
        int $ttl
    ) {
        $this->tokenBuilder = $tokenBuilder;
        $this->signer = $signer;
        $this->key = $key;
        $this->clock = $clock;
        $this->ttl = $ttl;
    }

    /** {@inheritdoc} */
    public function permittedFor(string ...$audiences): self
    {
        $builder = clone $this;
        $builder->tokenBuilder = $builder->tokenBuilder->permittedFor(...$audiences);

        return $builder;
    }

    /** {@inheritdoc} */
    public function expiresAt(\DateTimeImmutable $expiration = null): self
    {
        $builder = clone $this;
        if (null === $expiration) {
            $expiration = $builder->clock->now()->setTimestamp(time() + $builder->ttl);
        }

        $builder->tokenBuilder = $builder->tokenBuilder->expiresAt($expiration);

        return $builder;
    }

    /** {@inheritdoc} */
    public function identifiedBy(string $id = null): self
    {
        $builder = clone $this;
        if (null !== $id) {
            $builder->tokenBuilder = $builder->tokenBuilder->identifiedBy($id);
        }

        return $builder;
    }

    /** {@inheritdoc} */
    public function issuedAt(\DateTimeImmutable $issuedAt = null): self
    {
        $builder = clone $this;
        $builder->tokenBuilder = $builder->tokenBuilder->issuedAt($issuedAt ?? $this->clock->now());

        return $builder;
    }

    /** {@inheritdoc} */
    public function issuedBy(string $issuer = null): self
    {
        $builder = clone $this;
        if (null !== $issuer) {
            $builder->tokenBuilder = $builder->tokenBuilder->issuedBy($issuer);
        }

        return $builder;
    }

    /** {@inheritdoc} */
    public function canOnlyBeUsedAfter(\DateTimeImmutable $notBefore = null): self
    {
        $builder = clone $this;
        $builder->tokenBuilder = $builder->tokenBuilder->canOnlyBeUsedAfter($notBefore ?? $builder->clock->now());

        return $builder;
    }

    /** {@inheritdoc} */
    public function relatedTo(string $subject = null): self
    {
        $builder = clone $this;
        if (null !== $subject) {
            $builder->tokenBuilder = $builder->tokenBuilder->relatedTo($subject);
        }

        return $builder;
    }

    /** @param mixed $value */
    public function withHeader(string $name, $value): self
    {
        $builder = clone $this;
        $builder->tokenBuilder = $builder->tokenBuilder->withHeader($name, $value);

        return $builder;
    }

    /** {@inheritdoc} */
    public function withHeaders(array $headers = null): self
    {
        if (null === $headers) {
            return $this;
        }

        $builder = clone $this;
        /** @var mixed $value */
        foreach ($headers as $name => $value) {
            $builder = $builder->withHeader($name, $value);
        }

        return $builder;
    }

    /** @param mixed $value */
    public function withClaim(string $name, $value): self
    {
        $builder = clone $this;
        $builder->tokenBuilder = $builder->tokenBuilder->withClaim($name, $value);

        return $builder;
    }

    /** {@inheritdoc} */
    public function withClaims(array $claims = null): self
    {
        if (null === $claims) {
            return $this;
        }

        $builder = clone $this;
        /** @var mixed $value */
        foreach ($claims as $name => $value) {
            $builder = $builder->withClaim($name, $value);
        }

        return $builder;
    }

    /** {@inheritdoc} */
    public function getToken(JWT\Signer $signer = null, JWT\Signer\Key $key = null): JWT\Token
    {
        $builder = clone $this;

        return $builder->tokenBuilder->getToken($signer ?? $this->signer, $key ?? $this->key);
    }
}
