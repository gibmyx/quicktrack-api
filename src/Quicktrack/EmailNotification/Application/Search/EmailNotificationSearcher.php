<?php

declare(strict_types=1);

namespace Quicktrack\EmailNotification\Application\Search;

use Quicktrack\EmailNotification\Domain\Collection\EmailsNotification;
use Quicktrack\EmailNotification\Domain\Contract\EmailNotificationRepository;

final class EmailNotificationSearcher
{
    public function __construct(
        private EmailNotificationRepository $repository
    ) {
    }

    public function __invoke(EmailNotificationSearcherRequest $request)
    {
        return new EmailsNotification
        ($this->repository->matching($request->filters())
        );
    }

}
