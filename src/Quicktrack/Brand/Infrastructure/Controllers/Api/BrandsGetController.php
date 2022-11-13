<?php

declare(strict_types=1);

namespace Quicktrack\Brand\Infrastructure\Controllers\Api;

use Shared\Domain\Errors;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Quicktrack\Brand\Application\search\BrandSearcher;
use Quicktrack\Brand\Application\search\BrandSearcherRequest;

final class BrandsGetController extends Controller
{
    public function __construct(
        private BrandSearcher $searcher
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $brands = ($this->searcher)(new BrandSearcherRequest(
            $request->filters ?? [],
            $request->orderBy,
            $request->order,
            (int)$request->limit,
        ));

        if (Errors::getInstance()->hasErrors()) {
            return new JsonResponse(
                [
                    'ok' => false,
                    'content' => [],
                    'errors' => Errors::getInstance()->errorsMessage()
                ],
                JsonResponse::HTTP_BAD_REQUEST
            );
        }

        return new JsonResponse(
            [
                'ok' => true,
                'content' => [
                    'brands' => $brands->toArray(),
                    'total' => $brands->total(),
                    'lastPage' => $brands->lastPage(),
                    'currentPage' => $brands->currentPage()
                ],
                'errors' => []
            ],
            JsonResponse::HTTP_OK
        );
    }
}
