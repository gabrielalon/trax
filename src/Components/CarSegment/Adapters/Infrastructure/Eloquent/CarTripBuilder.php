<?php declare(strict_types=1);

namespace Components\CarSegment\Adapters\Infrastructure\Eloquent;

use Illuminate\Database\Eloquent\Builder;

final class CarTripBuilder extends Builder
{
    public function forCarId(string $carId): self
    {
        return $this->where('car_trips.car_id', '=', $carId);
    }

    public function forUserId(int $userId): self
    {
        return $this->where('car_trips.user_id', '=', $userId);
    }
}
