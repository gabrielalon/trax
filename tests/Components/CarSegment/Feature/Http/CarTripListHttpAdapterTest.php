<?php

declare(strict_types=1);

namespace Tests\Components\CarSegment\Feature\Http;

use Laravel\Passport\Passport;
use Symfony\Component\HttpFoundation\Response;
use Tests\Components\CarSegment\Utils\Seeders\CarsSeeder;
use Tests\Components\CarSegment\Utils\Seeders\UsersSeeder;
use Tests\TestCase;

final class CarTripListHttpAdapterTest extends TestCase
{
    /**
     * @test
     */
    public function shouldGetCarTrips(): void
    {
        Passport::actingAs($user = UsersSeeder::seedOne());
        $car = CarsSeeder::seedOneWithOwner($user);
        $trip = CarsSeeder::addTrip($car, $user);

        $response = $this
            ->json('GET', '/api/trips')
            ->assertStatus(Response::HTTP_OK)
            ->json();

        self::assertEquals(['data' => [
            [
                'id' => $trip->id,
                'date' => $trip->date->format('m/d/Y'),
                'miles' => $trip->miles,
                'total' => $trip->miles,
                'car' => [
                    'id' => $car->id,
                    'brand' => $car->brand_name,
                    'model' => $car->model_name,
                    'year' => $car->year,
                ],
            ],
        ]], $response);
    }

    /**
     * @test
     */
    public function shouldFailGettingCarTrips(): void
    {
        $response = $this
            ->json('GET', '/api/trips')
            ->assertStatus(Response::HTTP_UNAUTHORIZED)
            ->json();

        self::assertEquals('Unauthenticated.', $response['message']);
    }
}
