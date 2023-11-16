<?php

declare(strict_types=1);

namespace Atlance\JwtCore\Tests\Functional;

use Atlance\JwtCore\Token\Factory\SignerResolver;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class SignerResolverTest extends TestCase
{
    /** @param class-string<\Throwable>|null $exception */
    #[DataProvider('dataset')]
    public function test(string $algorithmId, string $exception = null): void
    {
        if (null !== $exception) {
            self::expectException($exception);
        }

        $signer = SignerResolver::resolve($algorithmId);

        self::assertInstanceOf(SignerResolver::ALGORITHM_MAP[$algorithmId], $signer);
    }

    public static function dataset(): \Generator
    {
        // Asymmetric algorithms
        yield 'ES256' => [SignerResolver::ES256];
        yield 'ES384' => [SignerResolver::ES384];
        yield 'ES512' => [SignerResolver::ES512];
        yield 'RS256' => [SignerResolver::RS256];
        yield 'RS384' => [SignerResolver::RS384];
        yield 'RS512' => [SignerResolver::RS512];
        // Symmetric algorithms
        yield 'HS256' => [SignerResolver::HS256];
        yield 'HS384' => [SignerResolver::HS384];
        yield 'HS512' => [SignerResolver::HS512];
        yield 'Foo' => ['Foo', \InvalidArgumentException::class];
    }
}
