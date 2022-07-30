<?php

declare(strict_types=1);

namespace Tests\Components\CarSegment\Integration\Infrastructure\Database;

use Components\CarSegment\Adapters\Infrastructure\Database\EloquentCarTrips;
use Components\CarSegment\Application\DomainModels\CarTrip;
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
        $model = CarTrip::create($user->id, $car->id, 12.32, $this->faker->date());

        $this->carTrips->save($model);

        $this->assertDatabaseHas('car_trips', [
            'car_id' => $car->id,
            'user_id' => $user->id,
            'miles' => $model->miles->value(),
            'date' => $model->date->value(),
        ]);
    }

    public function shouldRemoveCarTrip(): void
    {
        $user = UsersSeeder::seedOne();
        $car = CarsSeeder::seedOneWithOwner($user);
        $carTrip = CarsSeeder::addTrip($car, $user, $miles = 12.32);
        $model = CarTrip::create($user->id, $car->id, $miles, $carTrip->date->toDateTimeString());

        $this->carTrips->remove($model);

        $this->assertDatabaseMissing('car_trips', [
            'car_id' => $car->id,
            'user_id' => $user->id,
        ]);
    }
}
