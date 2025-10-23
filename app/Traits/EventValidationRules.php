<?php

namespace App\Traits;

trait EventValidationRules
{
    protected function storeValidationRule(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string',
            'capacity' => 'nullable|integer|max:255',
            'start' => 'required|date',
            'end' => 'required|date|after:start'
        ];
    }

    protected function updateValidationRules(): array
    {
        return [
            'name' => 'sometimes|required|max:255',
            'description' => 'nullable|string',
            'location' => 'sometimes|required|string',
            'capacity' => 'nullable|integer|max:255',
            'start' => 'sometimes|required|date',
            'end' => 'sometimes|required|date|after:start'
        ];
    }
}