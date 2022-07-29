<?php

declare(strict_types=1);

namespace Tests\Components\CarSegment\Feature\Http;

use Laravel\Passport\Passport;
use Symfony\Component\HttpFoundation\Response;
use Tests\Components\CarSegment\Utils\Seeders\CarsSeeder;
use Tests\Components\CarSegment\Utils\Seeders\UsersSeeder;
use Tests\TestCase;

final class CarRemoveHttpAdapterTest extends TestCase
{
    /**
     * @test
     */
    public function shouldRemoveCar(): void
    {
        Passport::actingAs($user = UsersSeeder::seedOne());
        $car = CarsSeeder::seedOneWithOwner($user);
        $trip = CarsSeeder::addTrip($car, $user);

        $this
            ->json('DELETE', "/api/car/{$car->id}")
            ->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseMissing('car_trips', [
            'id' => $trip->id,
        ]);

        $this->assertDatabaseMissing('car_owners', [
            'car_id' => $car->id,
            'user_id' => $user->id,
        ]);
    }

    /**
     * @test
     */
    public function shouldFailRemovingCar(): void
    {
        Passport::actingAs(UsersSeeder::seedOne());
        $car = CarsSeeder::seedOne();

        $response = $this
            ->json('DELETE', "/api/car/{$car->id}")
            ->assertStatus(Response::HTTP_FORBIDDEN)
            ->json();

        self::assertEquals('This action is unauthorized.', $response['message']);
    }
}
