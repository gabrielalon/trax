<?php declare(strict_types=1);

namespace Components\CarSegment\Application\Values;

use Carbon\Carbon;
use Webmozart\Assert\Assert;

final class TripDate
{
    public function __construct(
        private readonly string $value,
    ) {
        Assert::positiveInteger(
            strtotime($this->value),
            sprintf('<%s> does not allow the invalid trip date: <%s>.', __CLASS__, $this->value)
        );
    }

    public function value(): Carbon
    {
        return Carbon::createFromTimestamp(strtotime($this->value));
    }
}
