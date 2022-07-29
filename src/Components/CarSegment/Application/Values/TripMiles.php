<?php declare(strict_types=1);

namespace Components\CarSegment\Application\Values;

use Webmozart\Assert\Assert;

final class TripMiles
{
    public function __construct(
        private readonly float $value,
    ) {
        Assert::greaterThan(
            $this->value,
            0.0,
        );
    }

    public function value(): float
    {
        return $this->value;
    }
}
