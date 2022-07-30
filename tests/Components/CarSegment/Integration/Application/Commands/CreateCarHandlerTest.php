<?php

declare(strict_types=1);

namespace Tests\Components\CarSegment\Integration\Application\Commands;

use Components\CarSegment\Application\Commands\CreateCarWithOwner\CreateCarWithOwner;
use System\Messaging\CommandBus;
use Tests\Components\CarSegment\Utils\Seeders\UsersSeeder;
use Tests\TestCase;

final class CreateCarHandlerTest extends TestCase
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
    public function shouldHandleCreateCarWithOwner(): void
    {
        $user = UsersSeeder::seedOne();

        $command = new CreateCarWithOwner(
            $user->id,
            'Volvo',
            'XC 60',
            2022
        );

        $this->bus->dispatch($command);

        $this->assertDatabaseHas('car_owners', [
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('car_brands', [
            'name' => $command->brand,
        ]);

        $this->assertDatabaseHas('car_models', [
            'name' => $command->model,
        ]);

        $this->assertDatabaseHas('car_generations', [
            'year' => $command->year,
        ]);
    }
}
