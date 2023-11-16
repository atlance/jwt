<?php

declare(strict_types=1);

namespace Atlance\JwtCore\Tests\Configuration\Jwt;

use Atlance\JwtCore\Tests\Dto\AbstractCommand;

final class Options extends AbstractCommand
{
    /** In seconds. */
    public int $ttl;
}
