<?php declare(strict_types=1);

namespace Components\CarSegment\Application\Ports;

use Components\CarSegment\Application\Values\CarId;
use Components\CarSegment\Application\Values\TripDate;
use Components\CarSegment\Application\Values\TripMiles;
use Components\CarSegment\Application\Values\UserId;

interface CarTrips
{
    public function create(UserId $userId, CarId $carId, TripMiles $miles, TripDate $date): void;

    public function remove(UserId $userId, CarId $carId): void;
}
