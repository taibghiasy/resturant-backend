<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SignatureDish;
use Illuminate\Http\JsonResponse;

class SignatureDishApiController extends Controller
{
    public function index(): JsonResponse
    {
        $dishes = SignatureDish::orderBy('id','desc')->get(['id', 'name', 'description', 'image_url', 'price']);

        return response()->json(['data' => $dishes]);
    }

    public function show(SignatureDish $signatureDish): JsonResponse
    {
        return response()->json(['data' => $signatureDish]);
    }
}
