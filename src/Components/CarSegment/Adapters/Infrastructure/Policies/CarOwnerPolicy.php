<?php declare(strict_types=1);

namespace Components\CarSegment\Adapters\Infrastructure\Policies;

use App\User;
use Components\CarSegment\Adapters\Infrastructure\ORM\CarOwner;

final class CarOwnerPolicy
{
    public function access(User $user, string $carId): bool
    {
        return CarOwner::query()->forUser($user)->forCarId($carId)->exists();
    }
}
