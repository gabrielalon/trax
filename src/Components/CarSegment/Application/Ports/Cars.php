<?php declare(strict_types=1);

namespace Components\CarSegment\Application\Ports;

use Components\CarSegment\Application\Values\CarBrand;
use Components\CarSegment\Application\Values\CarId;
use Components\CarSegment\Application\Values\CarModel;
use Components\CarSegment\Application\Values\CarYear;

interface Cars
{
    public function create(CarBrand $brand, CarModel $model, CarYear $year): CarId;
}
