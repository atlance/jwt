<?php

declare(strict_types=1);

namespace Atlance\JwtCore\Token\Contracts;

use Atlance\JwtCore\Token\Contracts\DataSet\DataSetInterface;

interface EncodeInterface
{
    public function encode(DataSetInterface $dataSet): string;
}
