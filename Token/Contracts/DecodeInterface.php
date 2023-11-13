<?php

declare(strict_types=1);

namespace Atlance\JwtCore\Token\Contracts;

use Atlance\JwtCore\Token\Contracts\DataSet\DataSetInterface;

interface DecodeInterface
{
    public function decode(string $value): DataSetInterface;
}
