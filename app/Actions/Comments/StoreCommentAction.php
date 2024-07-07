<?php

declare(strict_types=1);

namespace App\Actions\Comments;

use App\Http\Requests\Api\V1\Comments\StoreCommentRequest;
use App\Models\Comment;

final class StoreCommentAction
{
    public function __invoke(StoreCommentRequest $request, int $taskId): Comment
    {
        $comment = Comment::create([
            'user_id' => auth()->id() ?? 1 /* TODO:REMOVE 1 */,
            'task_id' => $taskId,
            'text' => $request->validated('text'),
        ])->refresh();
        return $comment;
    }
}
