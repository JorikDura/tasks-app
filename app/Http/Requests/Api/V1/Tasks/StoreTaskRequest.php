<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\Tasks;

use App\Enums\Complexity;
use App\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'performerId' => ['nullable', 'int', 'exists:users,id'],
            'title' => ['required', 'string', 'min:6', 'max:48'],
            'description' => ['nullable', 'string', 'string'],
            'status' => ['required', Rule::enum(Status::class)],
            'complexity' => ['required', Rule::enum(Complexity::class)],
            'urgency' => ['required', 'int', 'min:1', 'max:10'],
            'deadlineAt' => ['nullable', 'date', 'date_format:d-m-Y'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
