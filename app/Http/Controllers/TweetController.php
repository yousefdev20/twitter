<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\Paginator;
use App\Http\Requests\StoreTweetRequest;
use Symfony\Component\HttpFoundation\Response;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse|Paginator
     */
    public function index(): JsonResponse|Paginator
    {
        $perPage = config('twitter.per_page');

        return auth()->user()->tweets()->withCount(['likes', 'replays', 'hasLiked as self_liked'])
            ->simplePaginate($perPage);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTweetRequest $request
     * @return \Illuminate\Http\Response|JsonResponse
     */
    public function store(StoreTweetRequest $request): \Illuminate\Http\Response|JsonResponse
    {
        $tweet = Tweet::query()->create($request->validated() + ['user_id' => auth()->id()]);

        if ($request->media) {
            $path = $request->file('media')
                ->store('public/' . auth()->user()?->name . '/' .
                    ($request->resource_type ?? 'image') .
                    '/' . date('Y-m-d')
                );

            $tweet->media()
                ->create([
                    'path' => $path, 'mediable_id' => auth()->id(), 'mediable_type' => Tweet::class,
                    'resource_type' => $request->resource_type,
                ]);
        }

        return $this->response($tweet, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Tweet $tweet
     * @return  \Illuminate\Http\Response|JsonResponse
     */
    public function show(Tweet $tweet): \Illuminate\Http\Response|JsonResponse
    {
        return $this->response(
            $tweet->loadCount(['likes', 'replays', 'hasLiked as self_liked']), Response::HTTP_OK
        );
    }

    /**
     * @param Tweet $tweet
     * @return \Illuminate\Http\Response|JsonResponse
     */
    public function like(Tweet $tweet): \Illuminate\Http\Response|JsonResponse
    {
        return $this->response($tweet->likes()->sync([['user_id' => auth()->id()]]), Response::HTTP_CREATED);
    }

    /**
     * @param Tweet $tweet
     * @return JsonResponse|\Illuminate\Http\Response
     */
    public function unlike(Tweet $tweet): \Illuminate\Http\Response|JsonResponse
    {
        return $this->response($tweet->likes()->detach(), Response::HTTP_CREATED);
    }
}
