<?php

declare(strict_types=1);

namespace Shared\Application\Find;

abstract class NextCodeFinder {
    
    protected function formatCodeSequential(int $sequential): string
    {
        return sprintf('%07s', $sequential);
    }

}