<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1\Comments;

use App\Http\Resources\Api\V1\Users\UserPreviewResource;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property int $user_id
 * @property string $text
 * @property string $created_at
 */
class CommentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /* @var Comment $this */
        return [
            'id' => $this->id,
            'user' => UserPreviewResource::make($this->whenLoaded('user')),
            'text' => $this->text,
            'createdAt' => $this->created_at,
        ];
    }
}
