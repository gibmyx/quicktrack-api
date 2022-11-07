<?php

declare(strict_types=1);

namespace Quicktrack\EmailNotification\Infrastructure\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Quicktrack\EmailNotification\Application\Create\EmailNotificationCreator;
use Quicktrack\EmailNotification\Application\Create\EmailNotificationCreatorRequest;
use Shared\Domain\Errors;

final class EmailNotificationPostController extends Controller
{
    public function __construct(
        private EmailNotificationCreator $creator
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            ($this->creator)(new EmailNotificationCreatorRequest(
                $request->id ?? '',
                $request->name ?? '',
                $request->email ?? ''
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
