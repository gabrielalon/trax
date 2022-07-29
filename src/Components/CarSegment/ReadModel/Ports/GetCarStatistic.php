<?php declare(strict_types=1);

namespace Components\CarSegment\ReadModel\Ports;

use Components\CarSegment\ReadModel\Model\CarStatisticDto;

interface GetCarStatistic
{
    public function getCarStatistic(int $userId, string $carId): CarStatisticDto;
}
