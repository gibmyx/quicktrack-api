<?php

declare(strict_types=1);

namespace Quicktrack\EmailNotification\Infrastructure\Controllers;

use Shared\Domain\Errors;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Quicktrack\EmailNotification\Application\Search\EmailNotificationSearcher;
use Quicktrack\EmailNotification\Application\Search\EmailNotificationSearcherRequest;
use function Lambdish\Phunctional\map;

final class EmailsNotificationGetController extends Controller
{

    public function __construct(
        private EmailNotificationSearcher $searcher
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $emailsNotification = ($this->searcher)(new EmailNotificationSearcherRequest(
            $request->filters ?? [],
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
                    'emailsNotification' => map(fn($email) => array_merge($email, ['mode' => 'update']), $emailsNotification->toArray())
                ],
                'errors' => []
            ],
            JsonResponse::HTTP_OK
        );
    }
}
