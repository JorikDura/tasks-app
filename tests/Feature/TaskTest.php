<?php

use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\get;

describe('tasks', function () {
    beforeEach(function () {
        $this->user = User::factory()->create();
    });

    it('tasks - 200', function () {
        get('/api/v1/tasks')
            ->assertStatus(200);
    });

    it('store post', function () {
        actingAs($this->user)
            ->post(
                uri: '/api/v1/tasks',
                data: [
                    'title' => 'testing',
                    'description' => 'testing',
                    'status' => 2,
                    'complexity' => 4,
                    'urgency' => 1,
                    'deadlineAt' => '21-01-2024'
                ]
            )->assertStatus(201);

        assertDatabaseHas(
            table: 'tasks',
            data: [
                'title' => 'testing',
                'description' => 'testing',
            ]
        );
    });
});
