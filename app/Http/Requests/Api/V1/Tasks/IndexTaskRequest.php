<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\Tasks;

use App\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexTaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'size' => ['nullable', 'int', 'min:1', 'max:20'],
            'status' => ['nullable', Rule::enum(Status::class)],
            'deadline' => ['nullable', 'array', 'max:1'],
            'deadline.*' => ['date', 'date_format:d-m-Y'],
        ];
    }
}
