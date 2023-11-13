<?php

declare(strict_types=1);

namespace Atlance\JwtCore\Tests\Unit;

use Atlance\JwtCore\Token\Contracts\DataSet\DataSetInterface;
use Atlance\JwtCore\Token\Factory\DataSetFactory;
use PHPUnit\Framework\TestCase;

class DataSetFactoryTest extends TestCase
{
    public function testFromHashtable(): void
    {
        self::assertInstanceOf(DataSetInterface::class, DataSetFactory::fromHashTable(['foo' => '1']));
    }
}
