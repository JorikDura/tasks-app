<?php

declare(strict_types=1);

namespace App\Filters\Api\V1\Tasks;

use App\Exceptions\Api\V1\Filters\FilterException;
use App\Filters\Api\Filter;
use App\Http\Requests\Api\V1\Tasks\IndexTaskRequest;
use Closure;
use Illuminate\Database\Eloquent\Builder;

final class DeadlineSearchFilter extends Filter
{
    /**
     * Where:
     * eq => Equals
     * mt => More than
     * lt => Less than
     * mti => More than including
     * lti => Less than including
     * @var array|string[]
     */
    protected array $operators = [
        'eq' => '=',
        'mt' => '>',
        'lt' => '<',
        'mti' => '>=',
        'lti' => '<='
    ];

    public function __construct(
        private readonly IndexTaskRequest $request
    ) {
    }

    /**
     * Filtering by deadline
     * @throws FilterException
     */
    public function handle(Builder $builder, Closure $next)
    {
        return $next($builder)
            ->when(
                $this->request->has('deadline'),
                function (Builder $builder) {
                    /** @var array{operator: string, value: string} $result */
                    $result = $this->getOperator($this->request->validated('deadline'), );
                    return $builder->whereRaw(
                        sql: "deadline_at {$result['operator']} to_date(?, 'DD-MM-YYYY')",
                        bindings: [$result['value']]
                    );
                }
            );
    }
}
