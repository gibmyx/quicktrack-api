<?php

declare(strict_types=1);


namespace Quicktrack\EmailNotification\Infrastructure\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Quicktrack\EmailNotification\Application\Create\EmailNotificationCreator;
use Quicktrack\EmailNotification\Application\Create\EmailNotificationCreatorRequest;
use Quicktrack\EmailNotification\Application\Delete\EmailNotificationDeleter;
use Quicktrack\EmailNotification\Application\Delete\EmailNotificationDeleterRequest;
use Shared\Domain\Errors;

final class EmailNotificationDeleteController extends Controller
{
    public function __construct(
        private EmailNotificationDeleter $deleter
    ) {
    }

    public function __invoke(string $id): JsonResponse
    {
        try {
            ($this->deleter)(new EmailNotificationDeleterRequest($id));
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
