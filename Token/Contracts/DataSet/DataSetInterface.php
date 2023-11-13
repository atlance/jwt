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
     * @return array<string, mixed>|null
     */
    public function claims(): ?array;

    /**
     * JWT headers as associative array.
     *
     * @return array<string, mixed>|null
     */
    public function headers(): ?array;

    /**
     * @param mixed $default
     *
     * @return mixed
     */
    public function get(string $name, $default = null);

    /**
     * @param mixed $value
     */
    public function set(string $name, $value): self;
}
