<?php

declare(strict_types=1);

namespace Quicktrack\EmailHistory\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Quicktrack\EmailHistory\Application\Create\EmailHistoryCreator;
use Quicktrack\EmailHistory\Application\Create\EmailHistoryCreatorRequest;
use Shared\Domain\Errors;

final class EmailHistoryPostController extends Controller
{
    public function __construct(
        private EmailHistoryCreator $creator
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            ($this->creator)(new EmailHistoryCreatorRequest(
                $request->id ?? '',
                $request->code ?? '',
                $request->name ?? '',
                $request->email ?? '',
                $request->phone ?? '',
                $request->message ?? '',
                $request->type ?? '',
            ));
            return $this->response();
        } catch (\Exception $exception) {

            $code = $exception->getCode() === 0
                ? JsonResponse::HTTP_BAD_REQUEST
                : $exception->getCode();

            return new JsonResponse([
                'ok' => false,
                'content' => [],
                'errors' => [$exception->getMessage()]
            ], $code);
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
