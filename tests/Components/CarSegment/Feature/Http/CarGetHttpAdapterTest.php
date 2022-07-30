<?php

declare(strict_types=1);

namespace Tests\Components\CarSegment\Feature\Http;

use Laravel\Passport\Passport;
use Symfony\Component\HttpFoundation\Response;
use Tests\Components\CarSegment\Utils\Seeders\CarsSeeder;
use Tests\Components\CarSegment\Utils\Seeders\UsersSeeder;
use Tests\TestCase;

final class CarGetHttpAdapterTest extends TestCase
{
    /**
     * @test
     */
    public function shouldGetCar(): void
    {
        Passport::actingAs($user = UsersSeeder::seedOne());
        $car = CarsSeeder::seedOneWithOwner($user);
        CarsSeeder::addTrip($car, $user, $miles1 = 12.5);
        CarsSeeder::addTrip($car, $user, $miles2 = 11.9);

        $response = $this
            ->json('GET', "/api/car/{$car->id}")
            ->assertStatus(Response::HTTP_OK)
            ->json();

        self::assertEquals(['data' => [
            'id' => $car->id,
            'brand' => $car->brand_name,
            'model' => $car->model_name,
            'year' => $car->year,
            'trip_count' => 2,
            'trip_miles' => $miles1 + $miles2,
        ]], $response);
    }

    /**
     * @test
     */
    public function shouldFailGettingCar(): void
    {
        Passport::actingAs(UsersSeeder::seedOne());
        $car = CarsSeeder::seedOne();

        $response = $this
            ->json('GET', "/api/car/{$car->id}")
            ->assertStatus(Response::HTTP_FORBIDDEN)
            ->json();

        self::assertEquals('This action is unauthorized.', $response['message']);
    }
}
