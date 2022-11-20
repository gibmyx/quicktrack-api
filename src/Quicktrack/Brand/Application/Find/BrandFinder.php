<?php

declare(strict_types=1);

namespace Quicktrack\Brand\Application\Find;

use Quicktrack\Brand\Domain\Contract\BrandRepository;
use Quicktrack\Brand\Domain\Entity\Brand;
use Quicktrack\Brand\Domain\ValueObjects\BrandId;
use Quicktrack\Brand\Domain\Services\BrandFinder as ServicesBrandFinder;

final class BrandFinder
{
    private $finder;

    public function __construct(
        private BrandRepository $repository
    ) {
        $this->finder = new ServicesBrandFinder($repository);
    }

    public function __invoke(
        BrandFinderRequest $request
    ): ?Brand {
        return ($this->finder)(new BrandId($request->id()));
    }
}
