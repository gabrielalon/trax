<?php declare(strict_types=1);

namespace Components\CarSegment\Application\Values;

use Webmozart\Assert\Assert;

final class UserId
{
    public function __construct(
        private readonly int $value,
    ) {
        Assert::positiveInteger($this->value);
    }

    public function value(): int
    {
        return $this->value;
    }
}
