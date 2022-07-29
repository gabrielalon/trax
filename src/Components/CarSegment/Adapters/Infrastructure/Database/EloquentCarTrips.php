<?php declare(strict_types=1);

namespace Components\CarSegment\Adapters\Infrastructure\Database;

use Components\CarSegment\Adapters\Infrastructure\ORM\Car;
use Components\CarSegment\Adapters\Infrastructure\ORM\CarTrip;
use Components\CarSegment\Adapters\Infrastructure\Transformers\CarTransformer;
use Components\CarSegment\Application\Ports\CarTrips;
use Components\CarSegment\Application\Values as VO;
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

    public function create(VO\UserId $userId, VO\CarId $carId, VO\TripMiles $miles, VO\TripDate $date): void
    {
        $car = Car::findOrFail($carId->value());

        $car->trips()->create([
            'user_id' => $userId->value(),
            'miles' => $miles->value(),
            'date' => $date->value(),
        ]);
    }

    public function remove(VO\UserId $userId, VO\CarId $carId): void
    {
        CarTrip::query()->forCarId($carId->value())->forUserId($userId->value())->delete();
    }
}
