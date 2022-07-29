<?php

declare(strict_types=1);

namespace Tests\Components\CarSegment\Utils\Seeders;

use App\User;
use Components\CarSegment\Adapters\Infrastructure\ORM\Car;
use Components\CarSegment\Adapters\Infrastructure\ORM\CarOwner;
use Components\CarSegment\Adapters\Infrastructure\ORM\CarTrip;

final class CarsSeeder
{
    public static function seedOne(array $data = []): Car
    {
        return Car::factory()->createOne($data);
    }

    public static function seedOneWithOwner(User $user, array $data = []): Car
    {
        $car = self::seedOne($data);

        CarOwner::factory()->createOne(['car_id' => $car->id, 'user_id' => $user->id]);

        return $car;
    }

    public static function addTrip(Car $car, User $user, float $miles = null): CarTrip
    {
        return CarTrip::factory()->createOne(['car_id' => $car->id, 'user_id' => $user->id, 'miles' => $miles ?? 12.5]);
    }
}
