<?php

declare(strict_types=1);

namespace Quicktrack\Brand\Application\Update;

use Quicktrack\Brand\Domain\Contract\BrandRepository;
use Quicktrack\Brand\Domain\Services\BrandFinder;
use Quicktrack\Brand\Domain\ValueObjects\BrandId;
use Quicktrack\Brand\Domain\ValueObjects\BrandName;
use Quicktrack\Brand\Domain\ValueObjects\BrandStatus;
use Quicktrack\Brand\Domain\ValueObjects\BrandValue;
use Shared\Domain\Errors;

final class BrandUpdater
{
    private BrandFinder $finder;

    public function __construct(
        private BrandRepository $repository
    ) {
        $this->finder = new BrandFinder($repository);
    }

    public function __invoke(BrandUpdaterRequest $request): void
    {
        $brand = ($this->finder)(new BrandId($request->id()));

        if (!Errors::getInstance()->hasErrors()) {
            $brand->changeName(new BrandName($request->name()));
            $brand->changeValue(new BrandValue($request->value()));
            $brand->changeStatus(new BrandStatus($request->status()));

            $this->repository->update($brand);
        }
    }
}
