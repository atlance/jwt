<?php

declare(strict_types=1);

namespace Atlance\JwtCore\Tests\Utils;

final class SetterMethodName
{
    private readonly string $name;

    private function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public static function fromSnakeCasePropertyName(string $propertyName): self
    {
        return new self(
            'set' . str_replace(
                ' ',
                '',
                mb_convert_case(
                    str_replace('_', ' ', $propertyName),
                    \MB_CASE_TITLE,
                    'UTF-8'
                )
            )
        );
    }
}
