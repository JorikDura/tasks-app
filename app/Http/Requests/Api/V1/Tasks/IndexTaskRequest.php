<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\Tasks;

use Illuminate\Foundation\Http\FormRequest;

class IndexTaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'size' => ['nullable', 'int', 'min:1', 'max:20'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
