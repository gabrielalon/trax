<?php declare(strict_types=1);

namespace Components\CarSegment\ReadModel\Ports;

use Components\CarSegment\ReadModel\Model\CarDto;

interface GetCars
{
    public function getCar(int $userId, string $carId): CarDto;

    /**
     * @return CarDto[]
     */
    public function getCars(int $userId): array;
}
