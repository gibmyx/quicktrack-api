<?php

declare(strict_types=1);

namespace Quicktrack\EmailHistory\Infrastructure\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Quicktrack\EmailHistory\Application\Find\EmailHistoryFinder;
use Quicktrack\EmailHistory\Application\Find\EmailHistoryFinderRequest;
use Shared\Domain\Errors;

final class EmailHistoryGetController extends Controller
{
    public function __construct(
        private EmailHistoryFinder $finder
    ) {
    }

    public function __invoke(string $id)
    {
        try {
            $response = ($this->finder)(new EmailHistoryFinderRequest($id));
            return $this->response($response);
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

    private function response($response)
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
            'content' => [
                'emailHistory' => $response->toArray()
            ],
            'errors' => []
        ], JsonResponse::HTTP_OK);
    }
}
