<?php

declare(strict_types=1);

namespace Quicktrack\EmailNotification\Application\Search;

use Shared\Domain\Criteria\Order;
use Shared\Domain\Criteria\Filters;
use Shared\Domain\Criteria\Criteria;
use Quicktrack\EmailNotification\Domain\Collection\EmailsNotification;
use Quicktrack\EmailNotification\Domain\Contract\EmailNotificationRepository;

final class EmailNotificationSearcher
{
    public function __construct(
        private EmailNotificationRepository $repository
    ) {
    }

    public function __invoke(EmailNotificationSearcherRequest $request): EmailsNotification
    {
        $criteria = new Criteria(
            Filters::fromValues($request->filters()),
            Order::fromValues($request->orderBy(), $request->order()),
            $request->limit()
        );

        return $this->repository->matching($criteria);
    }

}
