<?php

declare(strict_types=1);

namespace Tests\Components\CarSegment\Integration\Application\Commands;

use Carbon\Carbon;
use Components\CarSegment\Application\Commands\CreateCarTrip\CreateCarTrip;
use System\Messaging\CommandBus;
use Tests\Components\CarSegment\Utils\Seeders\CarsSeeder;
use Tests\Components\CarSegment\Utils\Seeders\UsersSeeder;
use Tests\TestCase;

final class CreateCarTripHandlerTest extends TestCase
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
    public function shouldHandleCreateCarTrip(): void
    {
        $user = UsersSeeder::seedOne();
        $car = CarsSeeder::seedOneWithOwner($user);

        $command = new CreateCarTrip(
            $user->id,
            $car->id,
            12.32,
            '2022-07-12T22:00:00.000Z'
        );

        $this->bus->dispatch($command);

        $this->assertDatabaseHas('car_trips', [
            'car_id' => $car->id,
            'user_id' => $user->id,
            'miles' => $command->miles,
            'date' => Carbon::createFromTimestamp(strtotime($command->date)),
        ]);
    }
}
