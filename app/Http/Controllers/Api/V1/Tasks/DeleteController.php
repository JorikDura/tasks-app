<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Tasks;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Throwable;

class DeleteController extends Controller
{
    /**
     * @throws Throwable
     */
    public function __invoke(Task $task)
    {
        $task->deleteOrFail();

        return response()->json([
            'status' => 'success',
        ]);
    }
}
