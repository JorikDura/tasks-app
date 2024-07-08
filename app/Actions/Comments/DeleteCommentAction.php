<?php

declare(strict_types=1);

namespace App\Actions\Comments;

use App\Models\Comment;
use Illuminate\Support\Facades\Gate;

final class DeleteCommentAction
{
    public function __invoke(int $taskId, int $commentId): void
    {
        $comment = Comment::where([
            'id' => $commentId,
            'task_id' => $taskId
        ])->firstOrFail();

        //Checking rights
        Gate::authorize('delete', $comment);

        $comment->delete();
    }
}
