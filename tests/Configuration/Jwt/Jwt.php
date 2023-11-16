<?php

declare(strict_types=1);

namespace Atlance\JwtCore\Tests\Configuration\Jwt;

use Atlance\JwtCore\Tests\Dto\AbstractCommand;

/** JWT configuration. */
final class Jwt extends AbstractCommand
{
    public Claims $claims;

    public Options $options;

    public function setClaims(array $value): void
    {
        $this->claims = Claims::fromArray($value);
    }

    public function setOptions(array $value): void
    {
        $this->options = Options::fromArray($value);
    }
}
