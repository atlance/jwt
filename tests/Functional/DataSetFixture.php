<?php

declare(strict_types=1);

namespace Atlance\JwtCore\Tests\Functional;

use Atlance\JwtCore\Tests\Configuration\Configuration;
use Atlance\JwtCore\Tests\Configuration\Factory\ConfigurationFactory;
use Atlance\JwtCore\Tests\Utils\Factory\DateTimeWithoutMicroseconds\Factory;
use Atlance\JwtCore\Token\Contracts\DataSet\DataSetInterface;
use Atlance\JwtCore\Token\Contracts\DataSet\RegisteredClaimsInterface as Claim;
use Atlance\JwtCore\Token\Factory\DataSetFactory;

/**
 * @psalm-suppress MixedArgumentTypeCoercion
 */
final class DataSetFixture
{
    private static ?Configuration $staticConfiguration;

    public static function full(array $override = []): DataSetInterface
    {
        // @phpstan-ignore-next-line
        return DataSetFactory::fromHashTable(array_merge_recursive(self::fullData(), $override));
    }

    public static function empty(array $dataSet = []): DataSetInterface
    {
        return DataSetFactory::fromHashTable($dataSet); // @phpstan-ignore-line
    }

    /**
     * @return non-empty-array<non-empty-string,mixed>
     */
    private static function fullData(): array
    {
        return [
            Claim::ISSUER => 'a',
            Claim::SUBJECT => 'b',
            Claim::AUDIENCE => ['c', 'd'],
            Claim::EXPIRATION_TIME => Factory::immutable(null, '+1 min'),
            Claim::NOT_BEFORE => Factory::immutable(),
            Claim::ISSUED_AT => Factory::immutable(),
            Claim::ID => 'b19a1ead-0088-4c0d-9f32-87c05e7e78a7',
            self::configuration()->jwt->claims->client_claim_name => '1',
            'headers' => [
                'typ' => 'JWT',
                'alg' => self::configuration()->openssl->algorithm_id,
            ],
        ];
    }

    private static function configuration(): Configuration
    {
        if (!isset(self::$staticConfiguration)) {
            self::$staticConfiguration = ConfigurationFactory::create();
        }

        return self::$staticConfiguration;
    }
}
