<?php

declare(strict_types=1);

namespace Atlance\JwtCore\Token\Contracts\Factory;

use Atlance\JwtCore\Token\Contracts\DataSet\DataSetInterface;
use Lcobucci\JWT;

interface TokenFactoryInterface
{
    public function create(DataSetInterface $dataSet): JWT\UnencryptedToken;
}
