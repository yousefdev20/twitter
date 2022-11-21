<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\FollowerRequest;
use App\Http\Resources\FollowerResource;

class FollowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse|Response
     */
    public function index(): JsonResponse|Response
    {
        return $this->response(auth()->user()->followers()->get());
    }

    public function store(FollowerRequest $request): JsonResponse
    {
        return $this->response(auth()->user()->followers()->create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return $this->response(FollowerResource::make(auth()->user()->followers()->find($id)));
    }
}
