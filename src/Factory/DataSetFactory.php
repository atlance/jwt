<?php

declare(strict_types=1);

namespace Atlance\JwtCore\Token\Factory;

use Atlance\JwtCore\Token\Contracts\DataSet\DataSetInterface;
use Atlance\JwtCore\Token\Contracts\Factory\DataSetFactoryInterface;
use Atlance\JwtCore\Token\DataSet;
use Lcobucci\JWT;

final class DataSetFactory implements DataSetFactoryInterface
{
    /** {@inheritdoc} */
    public static function fromHashTable(array $hashtable): DataSetInterface
    {
        return new DataSet($hashtable);
    }

    /** @psalm-suppress ArgumentTypeCoercion */
    public static function fromJWT(JWT\UnencryptedToken $jwt): DataSetInterface
    {
        // @phpstan-ignore-next-line
        return (new DataSet($jwt->claims()->all()))->set('headers', $jwt->headers()->all());
    }
}
