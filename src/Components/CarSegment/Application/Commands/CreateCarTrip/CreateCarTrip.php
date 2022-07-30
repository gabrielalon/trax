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
        public readonly int $userId,
        public readonly string $carId,
        public readonly float $miles,
        public readonly string $date,
    ) {
    }
}
