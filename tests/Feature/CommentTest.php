<?php

use App\Models\Comment;
use App\Models\Task;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

describe('comments test', function () {
    beforeEach(function () {
        $this->user = User::factory()->create();
        $this->task = Task::factory()->create();
    });

    it('create & delete', function () {
        actingAs($this->user)
            ->post(
                uri: "api/v1/tasks/{$this->task->id}/comment",
                data: [
                    'text' => 'canst thou no see? test!'
                ],
                headers: [
                    'Accept' => 'application/json'
                ]
            )->assertStatus(201);

        assertDatabaseHas(
            table: 'comments',
            data: [
                'text' => 'canst thou no see? test!'
            ]
        );

        actingAs($this->user)
            ->delete(
                uri: "api/v1/tasks/{$this->task->id}/comment/1",
                headers: [
                    'Accept' => 'application/json'
                ]
            )
            ->assertStatus(200);

        assertDatabaseMissing(
            table: 'comments',
            data: [
                'text' => 'canst thou no see? test!'
            ]
        );
    });

    it('cant delete', function () {
        $comment = Comment::factory()->create();
        $user = User::factory()->create();
        actingAs($user)
            ->delete(
                uri: "api/v1/tasks/$comment->task_id/comment/$comment->id",
                headers: [
                    'Accept' => 'application/json'
                ]
            )
            ->assertStatus(403);
    });
});
