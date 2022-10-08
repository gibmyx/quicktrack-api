<?php

declare(strict_types=1);

namespace Quicktrack\User\Infrastructure\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

final class ForgotPasswordController extends Controller
{
    private $messages = [
        Password::RESET_LINK_SENT => "Correo de enviado con exito.",
        Password::RESET_THROTTLED => "Por favor espere unos minutos para enviar nuevamente el correo.",
        Password::INVALID_USER => "El correo no es valido.",
    ];

    public function __invoke(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), ['email' => 'required|email',]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $status = Password::sendResetLink($request->only('email'));

        $code = $this->getCodeResponse($status);

        return response()->json([
            "message" => key_exists($status, $this->messages)
                ? $this->messages[$status]
                : "Ah currido un error. Por favor intentelo mas tarde",
            "ok" => $status == Password::RESET_LINK_SENT ? true : false
        ], $code);
    }

    private function getCodeResponse(string $status)
    {
        switch ($status) {
            case Password::RESET_LINK_SENT:
                return Response::HTTP_OK;

            case Password::RESET_THROTTLED:
                return Response::HTTP_UNPROCESSABLE_ENTITY;

            case Password::INVALID_USER:
                return Response::HTTP_BAD_REQUEST;

            default:
                return Response::HTTP_BAD_REQUEST;
        }
    }
}
