<?php

declare(strict_types=1);

namespace Quicktrack\Brand\Application\Create;

use Quicktrack\Brand\Domain\Contract\BrandRepository;
use Quicktrack\Brand\Domain\ValueObjects\BrandStatus;
use Quicktrack\Brand\Domain\ValueObjects\BrandValue;
use Quicktrack\Brand\Domain\ValueObjects\BrandName;
use Quicktrack\Brand\Domain\ValueObjects\BrandId;
use Quicktrack\Brand\Domain\Entity\Brand;
use Shared\Domain\Errors;

final class BrandCreator
{
    public function __construct(
        private BrandRepository $repository
    ) {
    }

    public function __invoke(BrandCreatorRequest $request): void
    {
        $brand = Brand::create(
            new BrandId($request->id()),
            new BrandValue($request->value()),
            new BrandName($request->name()),
            new BrandStatus($request->status())
        );

        if (!Errors::getInstance()->hasErrors()) {
            $this->repository->create($brand);
        }
    }
}
