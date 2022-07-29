<?php declare(strict_types=1);

namespace Components\CarSegment\Adapters\Infrastructure\Database;

use Components\CarSegment\Adapters\Infrastructure\ORM\CarOwner;
use Components\CarSegment\Application\Ports\CarOwnerAssigner;
use Components\CarSegment\Application\Values\CarId;
use Components\CarSegment\Application\Values\UserId;

final class EloquentCarOwners implements CarOwnerAssigner
{
    public function assignOwner(CarId $carId, UserId $userId): void
    {
        CarOwner::updateOrCreate(['car_id' => $carId->value(), 'user_id' => $userId->value()]);
    }

    public function unAssignOwner(CarId $carId, UserId $userId): void
    {
        CarOwner::query()->forCarId($carId->value())->forUserId($userId->value())->delete();
    }
}
