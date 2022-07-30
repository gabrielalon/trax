<?php declare(strict_types=1);

namespace Components\CarSegment\Adapters\Infrastructure\Database;

use Components\CarSegment\Adapters\Infrastructure\ORM\Car;
use Components\CarSegment\Adapters\Infrastructure\ORM\CarTrip;
use Components\CarSegment\Adapters\Infrastructure\Transformers\CarTransformer;
use Components\CarSegment\Application\DomainModels\CarTrip as DomainCarTrip;
use Components\CarSegment\Application\Ports\CarTrips;
use Components\CarSegment\ReadModel\Model\CarStatisticDto;
use Components\CarSegment\ReadModel\Model\CarTripDto;
use Components\CarSegment\ReadModel\Ports\GetCarStatistic;
use Components\CarSegment\ReadModel\Ports\GetCarTrips;
use System\Exceptions\NotFoundException;

final class EloquentCarTrips implements CarTrips, GetCarTrips, GetCarStatistic
{
    public function getCarStatistic(int $userId, string $carId): CarStatisticDto
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

        return new CarStatisticDto(
            $car->trips()->forUserId($userId)->count(),
            (float) $car->trips()->forUserId($userId)->sum('miles'),
            CarTransformer::toDto($car),
        );
    }

    public function getCarTrips(int $userId): array
    {
        $total = (float) CarTrip::query()->forUserId($userId)->sum('miles');

        return CarTrip::query()
            ->forUserId($userId)
            ->with('car', 'car.model', 'car.model.brand', 'car.generation')
            ->get()
            ->map(fn (CarTrip $carTrip) => new CarTripDto(
                $carTrip->id,
                $carTrip->date,
                $carTrip->miles,
                $total,
                CarTransformer::toDto($carTrip->car),
            ))
            ->toArray();
    }

    public function find(int $userId, string $carId): DomainCarTrip
    {
        $carTrip = CarTrip::query()
            ->forCarId($carId)
            ->forUserId($userId)
            ->first();

        if ($carTrip === null) {
            throw new NotFoundException(sprintf(
                'Car trip with car id `%s` and user id `%d` not found.',
                $carId,
                $userId,
            ));
        }

        assert($carTrip instanceof CarTrip);

        return DomainCarTrip::create(
            $userId,
            $carId,
            $carTrip->miles,
            $carTrip->date->toDateTimeString(),
        );
    }

    public function save(DomainCarTrip $model): void
    {
        $car = Car::findOrFail($model->carId->value());

        $car->trips()->create([
            'user_id' => $model->userId->value(),
            'miles' => $model->miles->value(),
            'date' => $model->date->value(),
        ]);
    }

    public function remove(DomainCarTrip $model): void
    {
        CarTrip::query()
            ->forCarId($model->carId->value())
            ->forUserId($model->userId->value())
            ->delete();
    }
}
