<?php

declare(strict_types=1);

namespace Quicktrack\User\Infrastructure\Controllers\Api;

use App\Http\Controllers\Controller;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTFactory;

final class VerifyTokenController extends Controller
{
    public function __invoke()
    {
//        desencriptar token
//        $token = JWTAuth::getToken();
//        $apy = JWTAuth::getPayload($token)->toArray();
//        $test  = JWTAuth::decode($token);

//        encriptar token personalizado
//        $customClaims = ['foo' => 'bar', 'baz' => 'bob'];
//        $payload = JWTFactory::make($customClaims);
//        $token2 = JWTAuth::encode($payload);

        return response()->json([
            'user' => auth()->user(),
            'authorisation' => [
                'access_token' => auth()->refresh(),
                'token_type' => 'bearer',
            ]
        ]);
    }
}
