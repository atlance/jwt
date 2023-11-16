<?php

declare(strict_types=1);

namespace Atlance\JwtCore\Token;

use Atlance\JwtCore\Token\Contracts\DataSet\DataSetInterface;

/**
 * @psalm-suppress MixedInferredReturnType
 * @psalm-suppress MixedReturnStatement
 * @psalm-suppress MixedReturnTypeCoercion
 */
final class DataSet implements DataSetInterface
{
    /** @var non-empty-array<non-empty-string, mixed> */
    private array $hashtable;

    /**
     * @param non-empty-array<non-empty-string, mixed> $hashtable
     */
    public function __construct(array $hashtable)
    {
        $this->hashtable = $hashtable;
    }

    /** {@inheritdoc} */
    public function iss(): ?string
    {
        return $this->get(self::ISSUER);
    }

    /** {@inheritdoc} */
    public function sub(): ?string
    {
        return $this->get(self::SUBJECT);
    }

    /** {@inheritdoc} */
    public function aud(): iterable
    {
        return $this->get(self::AUDIENCE) ?? [];
    }

    /** {@inheritdoc} */
    public function exp(): ?\DateTimeImmutable
    {
        return $this->get(self::EXPIRATION_TIME);
    }

    /** {@inheritdoc} */
    public function nbf(): ?\DateTimeImmutable
    {
        return $this->get(self::NOT_BEFORE);
    }

    /** {@inheritdoc} */
    public function iat(): ?\DateTimeImmutable
    {
        return $this->get(self::ISSUED_AT);
    }

    /** {@inheritdoc} */
    public function jti(): ?string
    {
        return $this->get(self::ID);
    }

    /**
     * @psalm-suppress MixedAssignment
     *
     * {@inheritdoc}
     */
    public function claims(): ?array
    {
        $claims = [];

        foreach ($this->hashtable as $name => $value) {
            if (!\in_array($name, self::REGISTERED_NAMES, true) && 'headers' !== $name) {
                $claims[$name] = $value;
            }
        }

        return [] === $claims ? null : $claims;
    }

    /** {@inheritdoc} */
    public function headers(): ?array
    {
        /** @var mixed $headers */
        $headers = $this->get('headers', []);

        return \is_array($headers) && [] !== $headers ? $headers : null;
    }

    /** {@inheritdoc} */
    public function get(string $name, $default = null)
    {
        return $this->hashtable[$name] ?? $default;
    }

    /** {@inheritdoc} */
    public function set(string $name, $value): self
    {
        $this->hashtable[$name] = $value;

        return $this;
    }
}
