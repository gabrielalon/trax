<?php declare(strict_types=1);

namespace Components\CarSegment\Application\Commands\CreateCarWithOwner;

use Components\CarSegment\Application\DomainModels\Car;
use Components\CarSegment\Application\Ports\CarOwnerAssigner;
use Components\CarSegment\Application\Ports\Cars;
use Components\CarSegment\Application\Values\UserId;
use System\Messaging\CommandBus\CommandContract;
use System\Messaging\CommandBus\CommandHandlerContract;

final class CreateCarWithOwnerHandler implements CommandHandlerContract
{
    public function __construct(
        private readonly Cars $cars,
        private readonly CarOwnerAssigner $assigner,
    ) {
    }

    public function handle(CommandContract $command): void
    {
        assert($command instanceof CreateCarWithOwner);

        $model = Car::create($command->brand, $command->model, $command->year);

        $carId = $this->cars->save($model);

        $this->assigner->assignOwner($carId, new UserId($command->userId));
    }
}
