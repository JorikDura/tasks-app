<?php

declare(strict_types=1);

namespace App\Actions\Comments;

use App\Http\Requests\Api\V1\Comments\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Task;

final class StoreCommentAction
{
    public function __invoke(StoreCommentRequest $request, int $taskId): Comment
    {
        return Task::findOrFail($taskId)->comments()->create([
            'user_id' => auth()->id(),
            'task_id' => $taskId,
            'text' => $request->validated('text'),
        ])->refresh()->load(['user']);
    }
}
