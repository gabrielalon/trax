<?php

declare(strict_types=1);

namespace Tests\Components\CarSegment\Integration\Infrastructure\Database;

use Components\CarSegment\Adapters\Infrastructure\Database\EloquentCarTrips;
use Components\CarSegment\Application\Values\CarId;
use Components\CarSegment\Application\Values\TripDate;
use Components\CarSegment\Application\Values\TripMiles;
use Components\CarSegment\Application\Values\UserId;
use Tests\Components\CarSegment\Utils\Seeders\CarsSeeder;
use Tests\Components\CarSegment\Utils\Seeders\UsersSeeder;
use Tests\TestCase;

final class EloquentCarTripsTest extends TestCase
{
    private EloquentCarTrips $carTrips;

    protected function setUp(): void
    {
        parent::setUp();

        $this->carTrips = $this->app->get(EloquentCarTrips::class);
    }

    /**
     * @test
     */
    public function shouldCreateCarTrip(): void
    {
        $user = UsersSeeder::seedOne();
        $car = CarsSeeder::seedOneWithOwner($user);
        $miles = new TripMiles(12.32);
        $date = new TripDate('2022-07-12T22:00:00.000Z');

        $this->carTrips->create(new UserId($user->id), new CarId($car->id), $miles, $date);

        $this->assertDatabaseHas('car_trips', [
            'car_id' => $car->id,
            'user_id' => $user->id,
            'miles' => $miles->value(),
            'date' => $date->value(),
        ]);
    }

    public function shouldRemoveCarTrip(): void
    {
        $user = UsersSeeder::seedOne();
        $car = CarsSeeder::seedOneWithOwner($user);

        $this->carTrips->remove(new UserId($user->id), new CarId($car->id));

        $this->assertDatabaseMissing('car_trips', [
            'car_id' => $car->id,
            'user_id' => $user->id,
        ]);
    }
}
