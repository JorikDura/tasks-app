<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1\Tasks;

use App\Enums\Complexity;
use App\Enums\Status;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property int $creator_id
 * @property int $performer_id
 * @property string $title
 * @property Status $status
 * @property Complexity $complexity
 * @property int $urgency
 * @property string $deadline_at
 */
class PreviewTaskResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /* @var Task $this */
        return [
            'id' => $this->id,
            'creatorId' => $this->creator_id,
            'performerId' => $this->performer_id,
            'title' => $this->title,
            'status' => Status::getWord($this->status),
            'complexity' => Complexity::getWord($this->complexity),
            'urgency' => $this->urgency,
            'deadlineAt' => $this->deadline_at
        ];
    }
}
