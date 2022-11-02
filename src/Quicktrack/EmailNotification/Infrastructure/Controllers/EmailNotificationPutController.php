<?php

declare(strict_types=1);

namespace Quicktrack\EmailNotification\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Quicktrack\EmailNotification\Application\Update\EmailNotificationUpdater;
use Quicktrack\EmailNotification\Application\Update\EmailNotificationUpdaterRequest;
use Shared\Domain\Errors;

final class EmailNotificationPutController extends Controller
{
    public function __construct(
        private EmailNotificationUpdater $updater
    ) {
    }

    public function __invoke(string $id, Request $request)
    {
        try {
            ($this->updater)(new EmailNotificationUpdaterRequest(
                $id,
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
