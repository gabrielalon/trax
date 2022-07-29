<?php

declare(strict_types=1);

namespace Database\Factories;

use Components\CarSegment\Adapters\Infrastructure\ORM\CarBrand;
use Components\CarSegment\Adapters\Infrastructure\ORM\CarModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @method static CarModelFactory new(array $attributes = [])
 * @method CarModel createOne($attributes = [])
 */
final class CarModelFactory extends Factory
{
    /** @var string */
    protected $model = CarModel::class;

    public function definition(): array
    {
        return [
            'brand_id' => CarBrand::factory()->createOne()->id,
            'name' => 'XC 60',
        ];
    }
}
