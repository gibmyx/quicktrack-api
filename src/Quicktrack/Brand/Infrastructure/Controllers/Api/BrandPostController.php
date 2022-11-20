<?php

declare(strict_types=1);

namespace Quicktrack\Brand\Infrastructure\Controllers\Api;

use Quicktrack\Brand\Application\Create\BrandCreatorRequest;
use Quicktrack\Brand\Application\Create\BrandCreator;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Shared\Domain\Errors;

final class BrandPostController extends Controller
{
    public function __construct(
        private BrandCreator $creator
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            ($this->creator)(new BrandCreatorRequest(
                $request->id ?? '',
                str_replace(" ", "-", strtolower(trim($request->name))) ?? '',
                $request->name ?? '',
                $request->status ?? '',
            ));
            return $this->response();
        } catch (\Exception $exception) {
            return new JsonResponse([
                'ok' => false,
                'content' => [],
                'errors' => [$exception->getMessage()]
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function response()
    {
        if (Errors::getInstance()->hasErrors()) {
            return new JsonResponse(
                [
                    'ok' => false,
                    'content' => [],
                    'errors' => Errors::getInstance()->errorsMessage()
                ],
                Errors::getInstance()->errorsCode()
            );
        }

        return new JsonResponse([
            'ok' => true,
            'content' => [],
            'errors' => []
        ], JsonResponse::HTTP_CREATED);
    }
}
