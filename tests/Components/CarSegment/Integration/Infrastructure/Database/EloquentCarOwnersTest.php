<?php

declare(strict_types=1);

namespace Tests\Components\CarSegment\Integration\Infrastructure\Database;

use Components\CarSegment\Adapters\Infrastructure\Database\EloquentCarOwners;
use Components\CarSegment\Application\Values\CarId;
use Components\CarSegment\Application\Values\UserId;
use Tests\Components\CarSegment\Utils\Seeders\CarsSeeder;
use Tests\Components\CarSegment\Utils\Seeders\UsersSeeder;
use Tests\TestCase;

final class EloquentCarOwnersTest extends TestCase
{
    private EloquentCarOwners $carOwners;

    protected function setUp(): void
    {
        parent::setUp();

        $this->carOwners = $this->app->get(EloquentCarOwners::class);
    }

    /**
     * @test
     */
    public function shouldAssignOwner(): void
    {
        $car = CarsSeeder::seedOne();
        $user = UsersSeeder::seedOne();

        $this->carOwners->assignOwner(new CarId($car->id), new UserId($user->id));

        $this->assertDatabaseHas('car_owners', [
            'user_id' => $user->id,
            'car_id' => $car->id,
        ]);
    }

    /**
     * @test
     */
    public function shouldUnAssignOwner(): void
    {
        $car = CarsSeeder::seedOne();
        $user = UsersSeeder::seedOne();

        $this->carOwners->unAssignOwner(new CarId($car->id), new UserId($user->id));

        $this->assertDatabaseMissing('car_owners', [
            'user_id' => $user->id,
            'car_id' => $car->id,
        ]);
    }
}
