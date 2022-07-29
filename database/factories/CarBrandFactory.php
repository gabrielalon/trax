<?php

declare(strict_types=1);

namespace Database\Factories;

use Components\CarSegment\Adapters\Infrastructure\ORM\CarBrand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @method static CarBrandFactory new(array $attributes = [])
 * @method CarBrand createOne($attributes = [])
 */
final class CarBrandFactory extends Factory
{
    /** @var string */
    protected $model = CarBrand::class;

    public function definition(): array
    {
        return [
            'name' => 'Volvo',
        ];
    }
}
