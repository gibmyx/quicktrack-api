<?php

declare(strict_types=1);

namespace Quicktrack\User\Infrastructure\Controllers\Api;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

final class LogoutController extends Controller
{
    public function __invoke(): Response
    {
        auth()->logout();
        return response()->noContent(200);
    }
}
