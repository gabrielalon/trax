<?php declare(strict_types=1);

namespace Components\CarSegment\Adapters\Infrastructure\Eloquent;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait WithBrandName
{
    protected function brandName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->model->brand->name,
        );
    }
}
