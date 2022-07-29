<?php declare(strict_types=1);

namespace Components\CarSegment\Application\Ports;

use Components\CarSegment\Application\Values\CarId;
use Components\CarSegment\Application\Values\UserId;

interface CarOwnerAssigner
{
    public function assignOwner(CarId $carId, UserId $userId): void;

    public function unAssignOwner(CarId $carId, UserId $userId): void;
}
