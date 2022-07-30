<?php

declare(strict_types=1);

namespace Tests\Components\CarSegment\Unit\Appllication\DomainModels;

use Components\CarSegment\Application\DomainModels\Car;
use Tests\TestCase;

final class CarTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCreateModel(): void
    {
        Car::create('Volvo', 'XC 60', (int) date('Y'));

        $this->expectNotToPerformAssertions();
    }
}
