<?php

declare(strict_types=1);

namespace Tests\Components\CarSegment\Unit\Appllication\Values;

use Components\CarSegment\Application\Values\CarBrand;
use Tests\TestCase;

final class CarBrandTest extends TestCase
{
    /**
     * @test
     */
    public function shouldGetValue(): void
    {
        $brand = new CarBrand($value = 'Volvo');

        self::assertEquals($value, $brand->value());
    }
}
