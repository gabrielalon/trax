<?php declare(strict_types=1);

namespace Components\CarSegment\ReadModel\Model;

use Carbon\Carbon;

class CarTripDto
{
    public function __construct(
        public readonly string $id,
        public readonly Carbon $date,
        public readonly float $miles,
        public readonly float $total,
        public readonly CarDto $carDto,
    ) {
    }
}
