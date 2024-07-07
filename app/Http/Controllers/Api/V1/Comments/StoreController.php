<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Comments;

use App\Actions\Comments\StoreCommentAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Comments\StoreCommentRequest;
use App\Http\Resources\Api\V1\Comments\CommentResource;

class StoreController extends Controller
{
    public function __invoke(
        StoreCommentRequest $request,
        StoreCommentAction $action,
        int $id
    ) {
        $comment = $action(request: $request, taskId: $id);

        return CommentResource::make($comment);
    }
}
