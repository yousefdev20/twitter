<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return JsonResponse|\Illuminate\Http\Response
     */
    public function show(User $user): \Illuminate\Http\Response|JsonResponse
    {
        return $this->response($user, Response::HTTP_OK);
    }
}
