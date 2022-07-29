<?php

declare(strict_types=1);

namespace Tests\Components\CarSegment\Unit\Appllication\Values;

use Components\CarSegment\Application\Values\CarModel;
use Tests\TestCase;

final class CarModelTest extends TestCase
{
    /**
     * @test
     */
    public function shouldGetValue(): void
    {
        $brand = new CarModel($value = 'XC 60');

        self::assertEquals($value, $brand->value());
    }
}
