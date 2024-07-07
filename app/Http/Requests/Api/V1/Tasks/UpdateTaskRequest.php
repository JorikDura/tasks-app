<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\Tasks;

use App\Enums\Complexity;
use App\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'performerId' => ['nullable', 'int', 'exists:users,id'],
            'title' => ['nullable', 'string', 'min:6', 'max:48'],
            'description' => ['nullable', 'string', 'string'],
            'status' => ['nullable', Rule::enum(Status::class)],
            'complexity' => ['nullable', Rule::enum(Complexity::class)],
            'urgency' => ['nullable', 'int', 'min:1', 'max:10'],
            'deadlineAt' => ['nullable', 'date', 'date_format:d-m-Y'],
        ];
    }
}
