<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\User as UserResource;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class LoginController extends Controller
{
    public function login(LoginRequest $request): JsonResponse|Response
    {
        if (Auth::attempt($request->validated())) {
            $user = Auth::user();
            $user['token'] = $user->createToken('user')->plainTextToken;

            return $this->response(UserResource::make($user), HttpResponse::HTTP_OK);
        }

        return $this->response(['message' => __('auth.failed')], 401);
    }
}
