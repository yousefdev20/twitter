<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register(LoginRequest $request)
    {
        if (Auth::attempt($request->validated())) {
        }
    }
}
