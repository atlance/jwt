<?php

declare(strict_types=1);

namespace Atlance\JwtCore\Token\Contracts\Builder\Decorator;

use Lcobucci\JWT;

/**
 * Decorator of Lcobucci\JWT\Builder for nullable arguments.
 */
interface JWTBuilderInterface extends JWT\Builder
{
    /** Appends new items to audience */
    public function permittedFor(string ...$audiences): self;

    /** Configures the expiration time */
    public function expiresAt(\DateTimeImmutable $expiration = null): self;

    /**
     * Configures the token id.
     */
    public function identifiedBy(string $id = null): self;

    /** Configures the time that the token was issued */
    public function issuedAt(\DateTimeImmutable $issuedAt = null): self;

    /**
     * Configures the issuer.
     */
    public function issuedBy(string $issuer = null): self;

    /** Configures the time before which the token cannot be accepted. */
    public function canOnlyBeUsedAfter(\DateTimeImmutable $notBefore = null): self;

    /**
     * Configures the subject.
     */
    public function relatedTo(string $subject = null): self;

    /** Returns a signed token to be used */
    public function getToken(JWT\Signer $signer = null, JWT\Signer\Key $key = null): JWT\Token\Plain;

    /**
     * Configures a claims.
     *
     * @param non-empty-array<string,mixed>|null $claims
     *
     * @throws JWT\Token\RegisteredClaimGiven when trying to set a registered claim
     */
    public function withClaims(array $claims = null): self;

    /**
     * Configures a headers.
     *
     * @param non-empty-array<string,mixed>|null $headers
     */
    public function withHeaders(array $headers = null): self;
}
