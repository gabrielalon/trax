<?php declare(strict_types=1);

namespace Components\CarSegment\Adapters\Infrastructure\Eloquent;

use Illuminate\Database\Eloquent\Builder;

final class CarBuilder extends Builder
{
    public function forUserId(int $userId): self
    {
        return $this->join('car_owners', 'car_owners.car_id', '=', 'cars.id') /** @phpstan-ignore-line */
            ->where('car_owners.user_id', '=', $userId);
    }
}
