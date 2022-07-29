<?php

declare(strict_types=1);

namespace Tests\Components\CarSegment\Feature\Http;

use Laravel\Passport\Passport;
use Symfony\Component\HttpFoundation\Response;
use Tests\Components\CarSegment\Utils\Assemblers\CarCreateRequestAssembler;
use Tests\Components\CarSegment\Utils\Seeders\UsersSeeder;
use Tests\TestCase;

final class CarCreateHttpAdapterTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCreateCar(): void
    {
        Passport::actingAs($user = UsersSeeder::seedOne());

        $payload = CarCreateRequestAssembler::new()->assemble();

        $this
            ->json('POST', '/api/car', $payload)
            ->assertStatus(Response::HTTP_CREATED);

        $this->assertDatabaseHas('car_owners', [
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('car_brands', [
            'name' => $payload['make'],
        ]);

        $this->assertDatabaseHas('car_models', [
            'name' => $payload['model'],
        ]);

        $this->assertDatabaseHas('car_generations', [
            'year' => $payload['year'],
        ]);
    }

    /**
     * @test
     */
    public function shouldFailCreateCar(): void
    {
        $payload = CarCreateRequestAssembler::new()->assemble();

        $response = $this
            ->json('POST', '/api/car', $payload)
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

        $response = $this
            ->json('POST', '/api/car', $payload)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->json();

        $this->assertCount(1, $response['errors']);
        $this->assertEquals($expectedError, $response['errors']);
    }

    public function provideInvalidPayloads(): array
    {
        return [
            'missing brand' => [
                CarCreateRequestAssembler::new()->withBrand(null)->assemble(),
                ['make' => ['The make field is required.']],
            ],
            'missing model' => [
                CarCreateRequestAssembler::new()->withModel(null)->assemble(),
                ['model' => ['The model field is required.']],
            ],
            'missing year' => [
                CarCreateRequestAssembler::new()->withYear(null)->assemble(),
                ['year' => ['The year field is required.']],
            ],
            'invalid brand' => [
                CarCreateRequestAssembler::new()->withBrand(124)->assemble(),
                ['make' => ['The make must be a string.']],
            ],
            'invalid model' => [
                CarCreateRequestAssembler::new()->withModel(124)->assemble(),
                ['model' => ['The model must be a string.']],
            ],
            'invalid year' => [
                CarCreateRequestAssembler::new()->withYear('wrong-year')->assemble(),
                ['year' => ['The year must be an integer.', 'The year must be at least 1901.']],
            ],
        ];
    }
}
