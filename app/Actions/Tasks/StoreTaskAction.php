<?php

declare(strict_types=1);

namespace App\Actions\Tasks;

use App\Http\Requests\Api\V1\Tasks\StoreTaskRequest;
use App\Models\Task;

final class StoreTaskAction
{
    public function __invoke(StoreTaskRequest $request): Task
    {
        $task = Task::create([
            'creator_id' => auth()->id() ?? 1 /* TODO:Remove this 1; */,
            'performer_id' => $request->validated('performerId'),
            'title' => $request->validated('title'),
            'description' => $request->validated('description'),
            'status' => $request->validated('status'),
            'complexity' => $request->validated('complexity'),
            'urgency' => $request->validated('urgency'),
            'deadline_at' => $request->validated('deadlineAt'),
        ])->load(['performer', 'creator']);
        return $task;
    }
}
