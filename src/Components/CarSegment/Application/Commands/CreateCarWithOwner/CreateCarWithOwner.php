<?php declare(strict_types=1);

namespace Components\CarSegment\Application\Commands\CreateCarWithOwner;

use Components\CarSegment\Application\Values\CarBrand;
use Components\CarSegment\Application\Values\CarModel;
use Components\CarSegment\Application\Values\CarYear;
use Components\CarSegment\Application\Values\UserId;
use System\Messaging\CommandBus\CommandContract;

final class CreateCarWithOwner implements CommandContract
{
    public function __construct(
        public readonly UserId $userId,
        public readonly CarBrand $brand,
        public readonly CarModel $model,
        public readonly CarYear $year,
    ) {
    }

    public static function fromRaw(
        int $userId,
        string $brand,
        string $model,
        int $year
    ): self {
        return new self(
            new UserId($userId),
            new CarBrand($brand),
            new CarModel($model),
            new CarYear($year),
        );
    }
}
