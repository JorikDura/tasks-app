<?php

declare(strict_types=1);

namespace App\Filters\Api;

use App\Exceptions\Api\V1\Filters\FilterException;

abstract class Filter
{
    protected array $operators = [];

    /**
     * Returns value and it's operator
     * @throws FilterException
     */
    protected function getOperator(array $input): array
    {
        $inputOperator = array_key_first($input);
        $inputValue = $input[$inputOperator];

        foreach ($this->operators as $operator => $value) {
            if ($inputOperator === $operator) {
                return [
                    'operator' => $value,
                    'value' => $inputValue
                ];
            }
        }

        throw FilterException::unknownFilter($inputOperator);
    }
}
