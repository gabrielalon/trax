<?php declare(strict_types=1);

namespace Components\CarSegment\Adapters\Infrastructure\Transformers;

use Components\CarSegment\Adapters\Infrastructure\ORM\Car;
use Components\CarSegment\ReadModel\Model\CarDto;

class CarTransformer
{
    public static function toDto(Car $car): CarDto
    {
        return new CarDto(
            $car->id,
            $car->brand_name,
            $car->model_name,
            $car->year,
        );
    }
}
