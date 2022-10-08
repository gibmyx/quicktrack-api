<?php

declare(strict_types=1);

namespace Quicktrack\User\Infrastructure\Controllers\Api;

use App\Http\Controllers\Controller;

final class VerifyTokenController extends Controller
{
    public function __invoke()
    {
        return response()->json([
            'user' => auth()->user(),
            'authorisation' => [
                'access_token' => auth()->refresh(),
                'token_type' => 'bearer',
            ]
        ]);
    }
}
