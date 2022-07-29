<?php declare(strict_types=1);

namespace Components\CarSegment\Application\Commands\CreateCarTrip;

use Components\CarSegment\Application\Values\CarId;
use Components\CarSegment\Application\Values\TripDate;
use Components\CarSegment\Application\Values\TripMiles;
use Components\CarSegment\Application\Values\UserId;
use System\Messaging\CommandBus\CommandContract;

final class CreateCarTrip implements CommandContract
{
    public function __construct(
        public readonly UserId $userId,
        public readonly CarId $carId,
        public readonly TripMiles $miles,
        public readonly TripDate $date,
    ) {
    }

    public static function fromRaw(
        int $userId,
        string $carId,
        float $miles,
        string $date,
    ): self {
        return new self(
            new UserId($userId),
            new CarId($carId),
            new TripMiles($miles),
            new TripDate($date),
        );
    }
}
