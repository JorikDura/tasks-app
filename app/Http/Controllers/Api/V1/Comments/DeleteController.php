<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Comments;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Throwable;

class DeleteController extends Controller
{
    /**
     * @throws Throwable
     */
    public function __invoke(int $taskId, int $commentId)
    {
        $comment = Comment::where([
            'id' => $commentId,
            'task_id' => $taskId
        ])->first();

        $comment->delete();

        return response()->json([
            'status' => 'success',
        ]);
    }
}
