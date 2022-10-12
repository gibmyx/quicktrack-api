<?php

declare(strict_types=1);

namespace Quicktrack\EmailHistory\Application\Find;

use Quicktrack\EmailHistory\Domain\ValueObjects\EmailHistoryId;
use Quicktrack\EmailHistory\Domain\Contract\EmailHistoryRepository;
use Quicktrack\EmailHistory\Domain\Services\EmailHistoryFinder as ServiceEmailHistoryFinder;

final class EmailHistoryFinder
{
    public function __construct(
        private EmailHistoryRepository $repository
    ) {
        $this->finder = new ServiceEmailHistoryFinder($repository);
    }

    public function __invoke(EmailHistoryFinderRequest $request)
    {
        return ($this->finder)(new EmailHistoryId($request->id()));
    }
}
