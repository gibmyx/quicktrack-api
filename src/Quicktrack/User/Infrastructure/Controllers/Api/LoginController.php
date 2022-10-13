<?php

declare(strict_types=1);

namespace Quicktrack\User\Infrastructure\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

final class LoginController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!$token = JWTAuth::attempt($validator->validated())) {
            return new JsonResponse(
                [
                    'ok' => false,
                    'content' => [],
                    'error' => []
                ],
                JsonResponse::HTTP_BAD_REQUEST
            );
        }

        return new JsonResponse(
            [
                'ok' => true,
                'content' => [
                    'user' => [
                        "id" => auth()->user()->id,
                        "name" => auth()->user()->name,
                        "email" => auth()->user()->email,
                    ],
                    'authorization' => ['access_token' => $token, 'token_type' => 'bearer',]
                ],
                'error' => []
            ],
            JsonResponse::HTTP_OK
        );
    }
}
