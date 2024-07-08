<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    use HandlesAuthorization;


    public function delete(User $user, Comment $comment): Response
    {
        return $user->id === $comment->user_id
            ? Response::allow()
            : Response::deny("You have no right to delete this comment");
    }

}
