<?php

declare(strict_types=1);

namespace Atlance\JwtCore\Tests\Utils\Factory\DateTimeWithoutMicroseconds;

final class Factory
{
    public static function mutable(?int $timestamp = null, ?string $modifier = null): \DateTime
    {
        $dateTime = (new \DateTime())->setTimestamp($timestamp ?? time());
        if (\is_string($modifier)) {
            $dateTime->modify($modifier);
        }

        return $dateTime;
    }

    public static function immutable(?int $timestamp = null, ?string $modifier = null): \DateTimeImmutable
    {
        return \DateTimeImmutable::createFromMutable(self::mutable($timestamp, $modifier));
    }
}
