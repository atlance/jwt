<?php

declare(strict_types=1);

namespace Atlance\JwtCore\Token\Contracts\DataSet;

/**
 * Is a container for registered and custom JWT claims + headers.
 */
interface DataSetInterface extends RegisteredClaimsInterface
{
    /**
     * Unregistered claims as associative array (MUST NOT contain registered names).
     *
     * @return non-empty-array<non-empty-string, mixed>|null
     */
    public function claims(): ?array;

    /**
     * JWT headers as associative array.
     *
     * @return non-empty-array<non-empty-string, mixed>|null
     */
    public function headers(): ?array;

    /**
     * @param mixed $default
     *
     * @return mixed|null
     */
    public function get(string $name, $default = null);

    /**
     * @param non-empty-string $name
     * @param mixed            $value
     *
     * @return $this
     */
    public function set(string $name, $value): self;
}
