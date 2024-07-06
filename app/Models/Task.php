<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Complexity;
use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'creator_id',
        'performer_id',
        'title',
        'description',
        'status',
        'complexity',
        'urgency',
        'deadline_at',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function performer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'performer_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    protected function casts(): array
    {
        return [
            'status' => Status::class,
            'complexity' => Complexity::class,
            'created_at' => 'date',
            'updated_at' => 'date',
            'deadline_at' => 'date',
        ];
    }
}
