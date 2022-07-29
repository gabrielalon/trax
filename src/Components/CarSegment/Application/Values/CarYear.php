<?php declare(strict_types=1);

namespace Components\CarSegment\Application\Values;

use Webmozart\Assert\Assert;

final class CarYear
{
    public function __construct(
        private readonly int $value,
    ) {
        Assert::greaterThan(
            $this->value,
            1900,
        );
    }

    public function value(): int
    {
        return $this->value;
    }
}
