<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Task $task): Response
    {
        return $user->id === $task->creator_id
            ? Response::allow()
            : Response::deny("You have no right to update this task");
    }

    public function delete(User $user, Task $task): Response
    {
        return $user->id === $task->creator_id
            ? Response::allow()
            : Response::deny("You have no right to delete this task");
    }
}
