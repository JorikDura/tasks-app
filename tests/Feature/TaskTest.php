<?php

use App\Models\Task;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\get;

describe('tasks', function () {
    beforeEach(function () {
        $this->user = User::factory()->create();
    });

    it('status 200', function () {
        actingAs($this->user)
            ->get(
                uri: '/api/v1/tasks',
                headers: [
                    'Accept' => 'application/json'
                ]
            )
            ->assertStatus(200);
    });

    it('field status', function () {
        actingAs($this->user)
            ->get(
                uri: '/api/v1/tasks?status=5',
                headers: [
                    'Accept' => 'application/json'
                ]
            )
            ->assertStatus(200);
    });

    it('field status 422', function () {
        actingAs($this->user)
            ->get(
                uri: '/api/v1/tasks?status=666',
                headers: [
                    'Accept' => 'application/json'
                ]
            )
            ->assertStatus(422);
    });

    it('field deadline', function () {
        actingAs($this->user)
            ->get(
                uri: '/api/v1/tasks?deadline[eq]=24-01-2024',
                headers: [
                    'Accept' => 'application/json'
                ]
            )
            ->assertStatus(200);
    });

    it('field deadline wrong', function () {
        actingAs($this->user)
            ->get(
                uri: '/api/v1/tasks?deadline[????test!!!!]=24-01-2024',
                headers: [
                    'Accept' => 'application/json'
                ]
            )
            ->assertStatus(415);
    });

    it('status 401', function () {
        get(
            uri: '/api/v1/tasks',
            headers: [
                'Accept' => 'application/json'
            ]
        )->assertStatus(401);
    });

    it('store & update & delete', function () {
        $test = actingAs($this->user)
            ->post(
                uri: '/api/v1/tasks',
                data: [
                    'title' => 'testing',
                    'description' => 'testing',
                    'status' => 2,
                    'complexity' => 4,
                    'urgency' => 1,
                    'deadlineAt' => '21-01-2024'
                ],
                headers: [
                    'Accept' => 'application/json'
                ]
            )->assertStatus(201);

        assertDatabaseHas(
            table: 'tasks',
            data: [
                'title' => 'testing',
                'description' => 'testing',
            ]
        );

        $taskId = $test->original->id;

        actingAs($this->user)
            ->post(
                uri: "/api/v1/tasks/$taskId",
                data: [
                    '_method' => 'patch',
                    'title' => 'still testing!',
                    'description' => 'u have done well',
                ],
                headers: [
                    'Accept' => 'application/json'
                ]
            )->assertStatus(200);

        assertDatabaseHas(
            table: 'tasks',
            data: [
                'title' => 'still testing!',
                'description' => 'u have done well',
            ]
        );

        actingAs($this->user)
            ->delete(
                uri: "/api/v1/tasks/$taskId",
                headers: [
                    'Accept' => 'application/json'
                ]
            )->assertStatus(200);

        assertDatabaseMissing(
            table: 'tasks',
            data: [
                'title' => 'still testing!',
                'description' => 'u have done well',
            ]
        );
    });

    it('cant update & delete', function () {
        $taskId = Task::factory()->create()->id;

        $user = User::factory()->create();

        actingAs($user)
            ->post(
                uri: "/api/v1/tasks/$taskId",
                data: [
                    '_method' => 'patch',
                    'title' => 'still testing!',
                    'description' => 'u have done well',
                ],
                headers: [
                    'Accept' => 'application/json'
                ]
            )->assertStatus(403);

        actingAs($user)
            ->delete(
                uri: "/api/v1/tasks/$taskId",
                headers: [
                    'Accept' => 'application/json'
                ]
            )->assertStatus(403);
    });
});
