<?php declare(strict_types=1);

namespace Components\CarSegment\Application\Values;

final class CarBrand
{
    public function __construct(
        private readonly string $value,
    ) {
    }

    public function value(): string
    {
        return $this->value;
    }
}
