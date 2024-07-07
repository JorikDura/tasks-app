<?php

declare(strict_types=1);

namespace App\Filters\Api\V1\Tasks;

use App\Http\Requests\Api\V1\Tasks\IndexTaskRequest;
use Closure;
use Illuminate\Database\Eloquent\Builder;

final readonly class StatusFilter
{
    public function __construct(
        private IndexTaskRequest $request
    ) {
    }

    public function handle(Builder $builder, Closure $next)
    {
        return $next($builder)
            ->when(
                $this->request->has('status'),
                function (Builder $builder) {
                    return $builder->where(
                        column: 'status',
                        operator: '=',
                        value: $this->request->validated('status')
                    );
                }
            );
    }
}
