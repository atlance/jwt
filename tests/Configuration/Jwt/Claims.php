<?php

declare(strict_types=1);

namespace Atlance\JwtCore\Tests\Configuration\Jwt;

use Atlance\JwtCore\Tests\Dto\AbstractCommand;

final class Claims extends AbstractCommand
{
    /** Unique identifier for current client. */
    /** @var non-empty-string */
    public string $client_claim_name;
}
