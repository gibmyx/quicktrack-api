<?php

namespace Quicktrack\User\Infrastructure\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class NewPasswordController extends Controller
{
    private $messages = [
        Password::PASSWORD_RESET => "Password changed successfully.",
        Password::INVALID_USER => "This email isn't valid.",
        Password::INVALID_TOKEN => "The password recovery link is not valid.",
    ];

    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $status = Password::broker()->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();
                event(new PasswordReset($user));
            }
        );

        $code = $this->getCodeResponse($status);

        return response()->json([
            "message" => key_exists($status, $this->messages)
                ? $this->messages[$status]
                : "An error has occurred. please try again later",
            "ok" => $status == Password::PASSWORD_RESET ? true : false
        ], $code);
    }

    private function getCodeResponse(string $status)
    {
        switch ($status) {
            case Password::PASSWORD_RESET:
                return Response::HTTP_OK;

            default:
                return Response::HTTP_BAD_REQUEST;
        }
    }
}
