<?php declare(strict_types=1);

namespace Components\CarSegment\Application\Ports;

use Components\CarSegment\Application\DomainModels\CarTrip;

interface CarTrips
{
    public function find(int $userId, string $carId): CarTrip;

    public function save(CarTrip $model): void;

    public function remove(CarTrip $model): void;
}
