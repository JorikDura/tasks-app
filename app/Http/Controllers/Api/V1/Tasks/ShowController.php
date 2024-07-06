<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Tasks\FullTaskResource;
use App\Models\Task;

class ShowController extends Controller
{
    public function __invoke(int $id)
    {
        $task = Task::with([
            'creator',
            'performer',
            'comments' => ['user'],
        ])->findOrFail($id);

        return FullTaskResource::make($task);
    }
}
