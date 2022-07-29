<?php

declare(strict_types=1);

namespace Tests\Components\CarSegment\Unit\ReadModel\Model;

use Components\CarSegment\ReadModel\Model\CarDto;
use PHPUnit\Framework\TestCase;

final class CarDtoTest extends TestCase
{
    private string $id;

    private string $brand;

    private string $model;

    private int $year;

    private CarDto $dto;

    protected function setUp(): void
    {
        $this->dto = new CarDto(
            $this->id = 'f5eb6f6c-fe6f-4472-91c1-f29653a9b41b',
            $this->brand = 'Volvo',
            $this->model = 'XC 60',
            $this->year = 2020,
        );
    }

    /**
     * @test
     */
    public function shouldGetId(): void
    {
        self::assertEquals($this->id, $this->dto->id);
    }

    /**
     * @test
     */
    public function shouldGetBrand(): void
    {
        self::assertEquals($this->brand, $this->dto->brand);
    }

    /**
     * @test
     */
    public function shouldGetModel(): void
    {
        self::assertEquals($this->model, $this->dto->model);
    }

    /**
     * @test
     */
    public function shouldGetYear(): void
    {
        self::assertEquals($this->year, $this->dto->year);
    }
}
