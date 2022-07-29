<?php

declare(strict_types=1);

namespace Database\Factories;

use Components\CarSegment\Adapters\Infrastructure\ORM\CarGeneration;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @method static CarGenerationFactory new(array $attributes = [])
 * @method CarGeneration createOne($attributes = [])
 */
final class CarGenerationFactory extends Factory
{
    /** @var string */
    protected $model = CarGeneration::class;

    public function definition(): array
    {
        return [
            'year' => date('Y'),
        ];
    }
}
