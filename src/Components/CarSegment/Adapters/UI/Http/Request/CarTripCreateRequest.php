<?php declare(strict_types=1);

namespace Components\CarSegment\Adapters\UI\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

final class CarTripCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'date' => 'required|date',
            'miles' => 'required|numeric|min:0.01',
        ];
    }

    public function validatedDate(): string
    {
        return $this->validated()['date'];
    }

    public function miles(): float
    {
        return (float) $this->validated()['miles'];
    }
}
