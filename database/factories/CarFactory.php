<?php

declare(strict_types=1);

namespace Database\Factories;

use Components\CarSegment\Adapters\Infrastructure\ORM\Car;
use Components\CarSegment\Adapters\Infrastructure\ORM\CarGeneration;
use Components\CarSegment\Adapters\Infrastructure\ORM\CarModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @method static CarFactory new(array $attributes = [])
 * @method Car createOne($attributes = [])
 */
final class CarFactory extends Factory
{
    /** @var string */
    protected $model = Car::class;

    public function definition(): array
    {
        return [
            'model_id' => CarModel::factory()->createOne()->id,
            'generation_id' => CarGeneration::factory()->createOne()->id,
        ];
    }
}
