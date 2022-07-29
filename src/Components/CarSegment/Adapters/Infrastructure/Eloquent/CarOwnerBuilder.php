<?php declare(strict_types=1);

namespace Components\CarSegment\Adapters\Infrastructure\Eloquent;

use App\User;
use Illuminate\Database\Eloquent\Builder;

final class CarOwnerBuilder extends Builder
{
    public function forCarId(string $carId): self
    {
        return $this->where('car_owners.car_id', '=', $carId);
    }

    public function forUser(User $user): self
    {
        return $this->forUserId($user->id);
    }

    public function forUserId(int $userId): self
    {
        return $this->where('car_owners.user_id', '=', $userId);
    }
}
