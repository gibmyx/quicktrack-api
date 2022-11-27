<?php

declare(strict_types=1);

namespace Quicktrack\User\Infrastructure\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Quicktrack\User\Application\Auth\AuthLogin;
use Quicktrack\User\Application\Auth\AuthLoginRequest;
use Shared\Domain\Errors;

final class LoginController extends Controller
{
    public function __construct(
        private AuthLogin $authLogin
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $response = ($this->authLogin)(new AuthLoginRequest($request->email ?? '', $request->password ?? ''));
            return $this->response($response);
        } catch (\Exception $exception) {

            return new JsonResponse([
                'ok' => false,
                'content' => [],
                'errors' => [$exception->getMessage()]
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function response(array $response)
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
            'content' => $response,
            'errors' => []
        ], JsonResponse::HTTP_OK);
    }
}
