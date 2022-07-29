<?php

declare(strict_types=1);

namespace Database\Factories;

use App\User;
use Components\CarSegment\Adapters\Infrastructure\ORM\Car;
use Components\CarSegment\Adapters\Infrastructure\ORM\CarOwner;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @method static CarOwnerFactory new(array $attributes = [])
 * @method CarOwner createOne($attributes = [])
 */
final class CarOwnerFactory extends Factory
{
    /** @var string */
    protected $model = CarOwner::class;

    public function definition(): array
    {
        return [
            'car_id' => Car::factory()->createOne()->id,
            'user_id' => User::factory()->createOne()->id,
        ];
    }
}
