<?php declare(strict_types=1);

namespace Components\CarSegment\Adapters\Infrastructure\Database;

use Components\CarSegment\Adapters\Infrastructure\ORM\Car;
use Components\CarSegment\Adapters\Infrastructure\ORM\CarBrand;
use Components\CarSegment\Adapters\Infrastructure\ORM\CarGeneration;
use Components\CarSegment\Adapters\Infrastructure\Transformers\CarTransformer;
use Components\CarSegment\Application\Ports\Cars;
use Components\CarSegment\Application\Values as VO;
use Components\CarSegment\ReadModel\Model\CarDto;
use Components\CarSegment\ReadModel\Ports\GetCars;
use System\Exceptions\NotFoundException;

final class EloquentCars implements Cars, GetCars
{
    public function getCar(int $userId, string $carId): CarDto
    {
        $car = Car::query()
            ->selectRaw('cars.*')
            ->forUserId($userId)
            ->find($carId);

        if ($car === null) {
            throw new NotFoundException(sprintf(
                'Car with id `%s` not found.',
                $carId
            ));
        }

        assert($car instanceof Car);

        return CarTransformer::toDto($car);
    }

    public function getCars(int $userId): array
    {
        return Car::query()
            ->selectRaw('cars.*')
            ->forUserId($userId)
            ->with('model', 'model.brand', 'generation')
            ->get()
            ->map(fn (Car $car) => CarTransformer::toDto($car))
            ->toArray();
    }

    public function create(VO\CarBrand $brand, VO\CarModel $model, VO\CarYear $year): VO\CarId
    {
        $carBrand = CarBrand::query()->updateOrCreate(['name' => $brand->value()]);
        $carModel = $carBrand->models()->updateOrCreate(['name' => $model->value()]);
        $carGeneration = CarGeneration::query()->updateOrCreate(['year' => $year->value()]);

        $car = Car::query()->updateOrCreate(['model_id' => $carModel->id, 'generation_id' => $carGeneration->id]);

        return new VO\CarId($car->id);
    }
}
