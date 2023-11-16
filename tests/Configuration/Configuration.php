<?php

declare(strict_types=1);

namespace Atlance\JwtCore\Tests\Configuration;

use Atlance\JwtCore\Tests\Configuration\Jwt\Jwt;
use Atlance\JwtCore\Tests\Configuration\Openssl\Openssl;
use Atlance\JwtCore\Tests\Dto\AbstractCommand;

final class Configuration extends AbstractCommand
{
    /** All about `openssl` keys. */
    public Openssl $openssl;

    /** JWT configuration. */
    public Jwt $jwt;

    public function setOpenssl(array $value): void
    {
        $this->openssl = Openssl::fromArray($value);
    }

    public function setJwt(array $value): void
    {
        $this->jwt = Jwt::fromArray($value);
    }
}
