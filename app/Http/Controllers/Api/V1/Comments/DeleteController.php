<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Comments;

use App\Actions\Comments\DeleteCommentAction;
use App\Http\Controllers\Controller;
use Throwable;

class DeleteController extends Controller
{
    /**
     * @throws Throwable
     */
    public function __invoke(
        int $taskId,
        int $commentId,
        DeleteCommentAction $action
    ) {
        $action(taskId: $taskId, commentId: $commentId);

        return response()->json([
            'status' => 'success',
        ]);
    }
}
