<?php declare(strict_types=1);

namespace Components\CarSegment\Application\DomainModels;

use Components\CarSegment\Application\Values as VO;

final class Car
{
    public function __construct(
        public readonly VO\CarBrand $brand,
        public readonly VO\CarModel $model,
        public readonly VO\CarYear $year,
    ) {
    }

    public static function create(string $brand, string $model, int $year): self
    {
        return new self(
            new VO\CarBrand($brand),
            new VO\CarModel($model),
            new VO\CarYear($year),
        );
    }
}
