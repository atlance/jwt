<?php

declare(strict_types=1);

namespace Atlance\JwtCore\Tests\Configuration\Openssl;

use Atlance\JwtCore\Tests\Dto\AbstractCommand;

/** All about `openssl` keys. */
final class Openssl extends AbstractCommand
{
    /** Signature algorithm id: 'ES256', 'ES384', 'ES512' etc. */
    public string $algorithm_id;
    /** # The path to `public.pem`. */
    public string $public_key;
    /** # The path to `private.pem`. */
    public string $private_key;
    /** The pass phrase for `private.pem`. */
    public string $private_passphrase;
}
