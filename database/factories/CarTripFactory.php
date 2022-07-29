<?php

declare(strict_types=1);

namespace Database\Factories;

use App\User;
use Carbon\Carbon;
use Components\CarSegment\Adapters\Infrastructure\ORM\CarModel;
use Components\CarSegment\Adapters\Infrastructure\ORM\CarTrip;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @method static CarTripFactory new(array $attributes = [])
 * @method CarTrip createOne($attributes = [])
 */
final class CarTripFactory extends Factory
{
    /** @var string */
    protected $model = CarTrip::class;

    public function definition(): array
    {
        return [
            'car_id' => CarModel::factory()->createOne()->id,
            'user_id' => User::factory()->createOne()->id,
            'date' => Carbon::now(),
            'miles' => 12.5,
        ];
    }
}
