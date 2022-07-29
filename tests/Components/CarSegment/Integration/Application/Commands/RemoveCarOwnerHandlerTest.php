<?php

declare(strict_types=1);

namespace Tests\Components\CarSegment\Integration\Application\Commands;

use Components\CarSegment\Application\Commands\RemoveCarOwner\RemoveCarOwner;
use System\Messaging\CommandBus;
use Tests\Components\CarSegment\Utils\Seeders\CarsSeeder;
use Tests\Components\CarSegment\Utils\Seeders\UsersSeeder;
use Tests\TestCase;

final class RemoveCarOwnerHandlerTest extends TestCase
{
    private CommandBus $bus;

    protected function setUp(): void
    {
        parent::setUp();

        $this->bus = $this->app->get(CommandBus::class);
    }

    /**
     * @test
     */
    public function shouldHandleRemoveCarTrip(): void
    {
        $user = UsersSeeder::seedOne();
        $car = CarsSeeder::seedOneWithOwner($user);
        $trip = CarsSeeder::addTrip($car, $user);

        $command = RemoveCarOwner::fromRaw(
            $user->id,
            $car->id,
        );

        $this->bus->dispatch($command);

        $this->assertDatabaseMissing('car_trips', [
            'id' => $trip->id,
        ]);

        $this->assertDatabaseMissing('car_owners', [
            'car_id' => $car->id,
            'user_id' => $user->id,
        ]);
    }
}
