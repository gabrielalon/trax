<?php declare(strict_types=1);

namespace Components\CarSegment\ReadModel\Ports;

use Components\CarSegment\ReadModel\Model\CarTripDto;

interface GetCarTrips
{
    /**
     * @return CarTripDto[]
     */
    public function getCarTrips(int $userId): array;
}
