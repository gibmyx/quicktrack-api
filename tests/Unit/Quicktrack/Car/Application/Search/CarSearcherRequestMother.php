<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\Car\Application\Search;

use Quicktrack\Car\Application\Search\CarSearcherRequest;

final class CarSearcherRequestMother
{

    public static function create(array $filters): CarSearcherRequest
    {
        return new CarSearcherRequest(
            $filters
        );
    }

    public static function byStatus(string $status): CarSearcherRequest
    {
        return self::create(
            [
                ['field' => 'status', 'value' => $status]
            ]
        );
    }
}