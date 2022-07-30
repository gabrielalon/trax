<?php declare(strict_types=1);

namespace Components\CarSegment\Adapters\UI\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

final class CarCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'year' => 'required|integer|min:1901',
            'brand' => 'required|string',
            'model' => 'required|string',
        ];
    }

    public function brand(): string
    {
        return $this->validated()['brand'];
    }

    public function model(): string
    {
        return $this->validated()['model'];
    }

    public function year(): int
    {
        return (int) $this->validated()['year'];
    }
}
