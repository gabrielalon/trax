<?php declare(strict_types=1);

namespace Components\CarSegment\ReadModel\Model;

class CarStatisticDto
{
    public function __construct(
        public readonly int $tripCount,
        public readonly float $tripMiles,
        public readonly CarDto $carDto,
    ) {
    }
}
