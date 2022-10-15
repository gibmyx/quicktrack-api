<?php

declare(strict_types=1);

namespace Quicktrack\User\Infrastructure\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Quicktrack\User\Application\Auth\AuthLogin;
use Quicktrack\User\Application\Auth\AuthLoginRequest;

final class LoginController extends Controller
{
    public function __construct(
        private AuthLogin $authLogin
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $response = ($this->authLogin)(new AuthLoginRequest($request->email, $request->password));
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

        return new JsonResponse([
            'ok' => true,
            'content' => $response,
            'errors' => []
        ], JsonResponse::HTTP_OK);
    }
}
