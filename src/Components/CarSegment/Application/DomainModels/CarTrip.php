<?php declare(strict_types=1);

namespace Components\CarSegment\Application\DomainModels;

use Components\CarSegment\Application\Values as VO;

final class CarTrip
{
    public function __construct(
        public readonly VO\UserId $userId,
        public readonly VO\CarId $carId,
        public readonly VO\TripMiles $miles,
        public readonly VO\TripDate $date,
    ) {
    }

    public static function create(int $userId, string $carId, float $miles, string $date): self
    {
        return new self(
            new VO\UserId($userId),
            new VO\CarId($carId),
            new VO\TripMiles($miles),
            new VO\TripDate($date),
        );
    }
}
