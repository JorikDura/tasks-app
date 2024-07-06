<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Tasks;

use App\Actions\Tasks\StoreTaskAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Tasks\StoreTaskRequest;
use App\Http\Resources\Api\V1\Tasks\FullTaskResource;

class StoreController extends Controller
{
    public function __invoke(StoreTaskRequest $request, StoreTaskAction $action)
    {
        $task = $action($request);

        return FullTaskResource::make($task);
    }
}
