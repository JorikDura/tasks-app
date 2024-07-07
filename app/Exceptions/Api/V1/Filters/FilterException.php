<?php

declare(strict_types=1);

namespace App\Exceptions\Api\V1\Filters;

use Exception;

class FilterException extends Exception
{
    public static function unknownFilter($filter): self
    {
        return new self("Unknown filter — $filter", 415);
    }
}
