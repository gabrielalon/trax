<?php

declare(strict_types=1);

namespace Tests\Components\CarSegment\Feature\Http;

use Laravel\Passport\Passport;
use Symfony\Component\HttpFoundation\Response;
use Tests\Components\CarSegment\Utils\Seeders\CarsSeeder;
use Tests\Components\CarSegment\Utils\Seeders\UsersSeeder;
use Tests\TestCase;

final class CarListHttpAdapterTest extends TestCase
{
    /**
     * @test
     */
    public function shouldGetCarList(): void
    {
        Passport::actingAs($user = UsersSeeder::seedOne());
        $car = CarsSeeder::seedOneWithOwner($user);

        $response = $this
            ->json('GET', '/api/cars')
            ->assertStatus(Response::HTTP_OK)
            ->json();

        self::assertEquals(['data' => [
            [
                'id' => $car->id,
                'brand' => $car->brand_name,
                'model' => $car->model_name,
                'year' => $car->year,
            ],
        ]], $response);
    }

    /**
     * @test
     */
    public function shouldFailGettingCarList(): void
    {
        CarsSeeder::seedOne();

        $response = $this
            ->json('GET', '/api/cars')
            ->assertStatus(Response::HTTP_UNAUTHORIZED)
            ->json();

        self::assertEquals('Unauthenticated.', $response['message']);
    }
}
