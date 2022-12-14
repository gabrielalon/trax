<?php

declare(strict_types=1);

namespace Tests\Components\CarSegment\Integration\Infrastructure\Database;

use Components\CarSegment\Adapters\Infrastructure\Database\EloquentCars;
use Components\CarSegment\Application\DomainModels\Car;
use Illuminate\Support\Arr;
use System\Exceptions\NotFoundException;
use Tests\Components\CarSegment\Utils\Seeders\CarsSeeder;
use Tests\Components\CarSegment\Utils\Seeders\UsersSeeder;
use Tests\TestCase;

final class EloquentCarsTest extends TestCase
{
    private EloquentCars $cars;

    protected function setUp(): void
    {
        parent::setUp();

        $this->cars = $this->app->get(EloquentCars::class);
    }

    /**
     * @test
     */
    public function shouldGetCar(): void
    {
        $user = UsersSeeder::seedOne();
        $car = CarsSeeder::seedOneWithOwner($user);

        $carDto = $this->cars->getCar($user->id, $car->id);

        self::assertEquals($car->id, $carDto->id);
        self::assertEquals($car->brand_name, $carDto->brand);
        self::assertEquals($car->model_name, $carDto->model);
        self::assertEquals($car->year, $carDto->year);
    }

    /**
     * @test
     */
    public function shouldFailedGetCar(): void
    {
        $user = UsersSeeder::seedOne();

        $this->expectExceptionObject(new NotFoundException(sprintf(
            'Car with id `%s` not found.',
            $carId = self::id()
        )));
        $this->cars->getCar($user->id, $carId);
    }

    /**
     * @test
     */
    public function shouldGetCars(): void
    {
        $user = UsersSeeder::seedOne();
        $car = CarsSeeder::seedOneWithOwner($user);

        $carsDto = $this->cars->getCars($user->id);
        $carDto = Arr::first($carsDto);

        self::assertEquals($car->id, $carDto->id);
        self::assertEquals($car->brand_name, $carDto->brand);
        self::assertEquals($car->model_name, $carDto->model);
        self::assertEquals($car->year, $carDto->year);
    }

    /**
     * @test
     */
    public function shouldCreateCar(): void
    {
        $car = Car::create('Volvo', 'XC 60', (int) date('Y'));

        $carId = $this->cars->save($car);

        $this->assertDatabaseHas('cars', [
            'id' => $carId->value(),
        ]);

        $this->assertDatabaseHas('car_brands', [
            'name' => $car->brand->value(),
        ]);

        $this->assertDatabaseHas('car_models', [
            'name' => $car->model->value(),
        ]);

        $this->assertDatabaseHas('car_generations', [
            'year' => $car->year->value(),
        ]);
    }
}
