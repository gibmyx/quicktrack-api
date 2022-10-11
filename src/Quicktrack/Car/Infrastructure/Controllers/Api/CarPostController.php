<?php

declare(strict_types=1);

namespace Quicktrack\Car\Infrastructure\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Quicktrack\Car\Application\Create\CarCreator;
use Quicktrack\Car\Application\Create\CarCreatorRequest;

final class CarPostController extends Controller
{
    private $creator;

    public function __construct(
        CarCreator $creator
    )
    {
        $this->creator = $creator;
    }

    public function __invoke(Request $request): JsonResponse
    {
        dd($this->creator, $request);
        ($this->creator)(new CarCreatorRequest(
            $request->input('id'),
            $request->input('code'),
            $request->input('brad'),
            $request->input('model'),
            $request->input('color'),
            $request->input('fuel'),
            $request->input('gearbox'),
            $request->input('kilometer'),
            $request->input('price'),
            $request->input('type'),
            $request->input('year'),
            $request->input('status'),
        ));

        return new JsonResponse([], JsonResponse::HTTP_OK);
    }
}