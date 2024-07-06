<?php

use App\Models\User;

use function Pest\Laravel\assertDatabaseHas;
use function PHPUnit\Framework\assertTrue;

it('base test', function () {
    assertTrue(true);
    User::create([
        'name' => 'test',
        'email' => 'test@test.com',
        'password' => 'test',
    ]);
    assertDatabaseHas(
        table: 'users',
        data: [
            'name' => 'test',
            'email' => 'test@test.com'
        ]
    );
});
