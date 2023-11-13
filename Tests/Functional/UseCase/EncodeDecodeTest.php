<?php

declare(strict_types=1);

namespace Atlance\JwtCore\Tests\Functional\UseCase;

use Atlance\JwtCore\Tests\Functional\DataSetFixture;
use Atlance\JwtCore\Tests\Functional\KernelTestCase;
use Atlance\JwtCore\Tests\Utils\Factory\DateTimeWithoutMicroseconds\Factory;
use Atlance\JwtCore\Token\Contracts\DataSet\DataSetInterface;
use Atlance\JwtCore\Token\Contracts\DataSet\RegisteredClaimsInterface as Claim;

/**
 * Questions about dates:
 *
 * @see https://github.com/lcobucci/jwt/issues/229#issuecomment-381999943
 * @see https://datatracker.ietf.org/doc/html/draft-ietf-oauth-json-web-token-32#page-6
 *
 * NumericDate
 *   A JSON numeric value representing the number of seconds
 *   from 1970-01-01T00:00:00Z UTC until the specified UTC date/time, ignoring leap seconds.
 */
final class EncodeDecodeTest extends KernelTestCase
{
    /**
     * @dataProvider dataset
     *
     * @param class-string<\Throwable>|null $exception
     */
    public function test(DataSetInterface $dataSet, string $exception = null): void
    {
        if (null !== $exception) {
            self::expectException($exception);
        }

        self::assertEquals($dataSet->claims(), $this->decode($this->encode($dataSet))->claims());
    }

    public static function dataset(): \Generator
    {
        yield 'OK: full dataset' => [DataSetFixture::full(['headers' => ['header-1' => 1, 'header-2' => '2']])];
        yield 'OK: minimum' => [
            DataSetFixture::empty([
                self::configuration()->jwt->claims->client_claim_name => '1',
            ]),
        ];
        yield 'KO: EXPIRATION_TIME' => [
            DataSetFixture::full([Claim::EXPIRATION_TIME => Factory::immutable()]),
            \Throwable::class,
        ];
        yield 'KO: HAS CLAIM VALIDATOR' => [DataSetFixture::empty(), \Throwable::class];
    }
}
