<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Tasks;

use App\Filters\Api\V1\Tasks\DeadlineSearchFilter;
use App\Filters\Api\V1\Tasks\StatusFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Tasks\IndexTaskRequest;
use App\Http\Resources\Api\V1\Tasks\PreviewTaskResource;
use App\Models\Task;
use Illuminate\Support\Facades\Pipeline;

class IndexController extends Controller
{
    private const int DEFAULT_PAGE_SIZE = 15;

    public function __invoke(IndexTaskRequest $request)
    {
        $pageSize = $request->validated(
            key: 'size',
            default: self::DEFAULT_PAGE_SIZE
        );

        $tasksQuery = Pipeline::send(Task::query())
            ->through([
                StatusFilter::class,
                DeadlineSearchFilter::class
            ])
            ->thenReturn();

        $tasks = $tasksQuery
            ->paginate($pageSize)
            ->appends($request->query());

        return PreviewTaskResource::collection($tasks);
    }
}
