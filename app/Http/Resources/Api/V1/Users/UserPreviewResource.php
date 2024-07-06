<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1\Users;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property string $name
 */
class UserPreviewResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /* @var User $this */
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
