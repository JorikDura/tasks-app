<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1\Tasks;

use App\Enums\Complexity;
use App\Enums\Status;
use App\Http\Resources\Api\V1\Comments\CommentResource;
use App\Http\Resources\Api\V1\Users\UserPreviewResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property int $creator_id
 * @property int $performer_id
 * @property string $title
 * @property string $description
 * @property Status $status
 * @property Complexity $complexity
 * @property int $urgency
 * @property string $created_at
 * @property string $updated_at
 * @property string $deadline_at
 */
class FullTaskResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /* @var Task $this */
        return [
            'id' => $this->id,
            'creator' => UserPreviewResource::make($this->whenLoaded('creator')),
            'performer' => UserPreviewResource::make($this->whenLoaded('performer')),
            'title' => $this->title,
            'description' => $this->description,
            'status' => Status::getWord($this->status),
            'complexity' => Complexity::getWord($this->complexity),
            'urgency' => $this->urgency,
            'comments' => CommentResource::collection($this->whenLoaded('comments')),
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'deadlineAt' => $this->deadline_at
        ];
    }
}
