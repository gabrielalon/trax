<?php

declare(strict_types=1);

namespace Tests\Components\CarSegment\Unit\Appllication\Values;

use Components\CarSegment\Application\Values\UserId;
use Tests\TestCase;
use Webmozart\Assert\InvalidArgumentException;

final class UserIdTest extends TestCase
{
    /**
     * @test
     */
    public function shouldGetValue(): void
    {
        $brand = new UserId($value = 12);

        self::assertEquals($value, $brand->value());
    }

    /**
     * @test
     */
    public function shouldFailGettingValue(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new UserId(-12);
    }
}
