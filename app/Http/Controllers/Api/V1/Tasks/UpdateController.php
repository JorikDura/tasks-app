<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Tasks;

use App\Actions\Tasks\UpdateTaskAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Tasks\UpdateTaskRequest;
use App\Http\Resources\Api\V1\Tasks\FullTaskResource;

class UpdateController extends Controller
{
    public function __invoke(
        UpdateTaskRequest $request,
        UpdateTaskAction $action,
        int $id,
    ) {
        $updatedTask = $action(request: $request, id: $id);

        return FullTaskResource::make($updatedTask);
    }
}
