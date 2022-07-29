<?php declare(strict_types=1);

namespace Components\CarSegment\Adapters\Infrastructure\Eloquent;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait WithModelName
{
    protected function modelName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->model->name,
        );
    }
}
