<?php

declare(strict_types=1);

namespace Atlance\JwtCore\Token\Contracts\Factory;

use Atlance\JwtCore\Token\Contracts\DataSet\DataSetInterface;
use Lcobucci\JWT;

interface DataSetFactoryInterface
{
    /** @param non-empty-array<non-empty-string,mixed> $hashtable */
    public static function fromHashTable(array $hashtable): DataSetInterface;

    public static function fromJWT(JWT\UnencryptedToken $jwt): DataSetInterface;
}
