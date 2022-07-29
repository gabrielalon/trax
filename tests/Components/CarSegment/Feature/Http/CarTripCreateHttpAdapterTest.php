<?php

declare(strict_types=1);

namespace Tests\Components\CarSegment\Feature\Http;

use Carbon\Carbon;
use Laravel\Passport\Passport;
use Symfony\Component\HttpFoundation\Response;
use Tests\Components\CarSegment\Utils\Assemblers\CarTripCreateRequestAssembler;
use Tests\Components\CarSegment\Utils\Seeders\CarsSeeder;
use Tests\Components\CarSegment\Utils\Seeders\UsersSeeder;
use Tests\TestCase;

final class CarTripCreateHttpAdapterTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCreateCarTrip(): void
    {
        Passport::actingAs($user = UsersSeeder::seedOne());
        $car = CarsSeeder::seedOneWithOwner($user);

        $payload = CarTripCreateRequestAssembler::new()->assemble();

        $this
            ->json('POST', "/api/car/{$car->id}/trip", $payload)
            ->assertStatus(Response::HTTP_CREATED);

        $this->assertDatabaseHas('car_trips', [
            'car_id' => $car->id,
            'user_id' => $user->id,
            'miles' => $payload['miles'],
            'date' => Carbon::createFromTimestamp(strtotime($payload['date'])),
        ]);
    }

    /**
     * @test
     */
    public function shouldFailCreateCar(): void
    {
        $user = UsersSeeder::seedOne();
        $car = CarsSeeder::seedOneWithOwner($user);

        $payload = CarTripCreateRequestAssembler::new()->assemble();

        $response = $this
            ->json('POST', "/api/car/{$car->id}/trip", $payload)
            ->assertStatus(Response::HTTP_UNAUTHORIZED)
            ->json();

        self::assertEquals('Unauthenticated.', $response['message']);
    }

    /**
     * @test
     * @dataProvider provideInvalidPayloads
     */
    public function shouldFailCreateCarOnValidation(array $payload, array $expectedError): void
    {
        Passport::actingAs($user = UsersSeeder::seedOne());
        $car = CarsSeeder::seedOneWithOwner($user);

        $response = $this
            ->json('POST', "/api/car/{$car->id}/trip", $payload)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->json();

        $this->assertCount(1, $response['errors']);
        $this->assertEquals($expectedError, $response['errors']);
    }

    public function provideInvalidPayloads(): array
    {
        return [
            'missing date' => [
                CarTripCreateRequestAssembler::new()->withDate(null)->assemble(),
                ['date' => ['The date field is required.']],
            ],
            'missing miles' => [
                CarTripCreateRequestAssembler::new()->withMiles(null)->assemble(),
                ['miles' => ['The miles field is required.']],
            ],
            'invalid date' => [
                CarTripCreateRequestAssembler::new()->withDate(124)->assemble(),
                ['date' => ['The date is not a valid date.']],
            ],
            'invalid miles' => [
                CarTripCreateRequestAssembler::new()->withMiles('wrong-year')->assemble(),
                ['miles' => ['The miles must be a number.']],
            ],
            'invalid miles 2' => [
                CarTripCreateRequestAssembler::new()->withMiles(-2)->assemble(),
                ['miles' => ['The miles must be at least 0.01.']],
            ],
        ];
    }
}
