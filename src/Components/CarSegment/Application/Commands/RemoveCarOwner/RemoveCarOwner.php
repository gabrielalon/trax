<?php declare(strict_types=1);

namespace Components\CarSegment\Application\Commands\RemoveCarOwner;

use Components\CarSegment\Application\Values\CarId;
use Components\CarSegment\Application\Values\UserId;
use System\Messaging\CommandBus\CommandContract;

final class RemoveCarOwner implements CommandContract
{
    public function __construct(
        public readonly UserId $userId,
        public readonly CarId $carId
    ) {
    }

    public static function fromRaw(int $userId, string $carId): self
    {
        return new self(new UserId($userId), new CarId($carId));
    }
}
