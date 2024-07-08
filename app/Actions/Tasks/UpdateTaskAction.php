<?php

declare(strict_types=1);

namespace App\Actions\Tasks;

use App\Http\Requests\Api\V1\Tasks\UpdateTaskRequest;
use App\Models\Task;

final class UpdateTaskAction
{
    public function __invoke(UpdateTaskRequest $request, Task $task): Task
    {
        return tap($task)->update([
            'performer_id' => $request->validated('performerId', $task->performer_id),
            'title' => $request->validated('title', $task->title),
            'description' => $request->validated('description', $task->description),
            'status' => $request->validated('status', $task->status),
            'complexity' => $request->validated('complexity', $task->complexity),
            'urgency' => $request->validated('urgency', $task->urgency),
            'deadline_at' => $request->validated('deadlineAt', $task->deadline_at)
        ])->load(
            [
                'performer',
                'creator'
            ]
        );
    }
}
