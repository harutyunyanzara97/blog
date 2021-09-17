<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function likeBlog(Request $request)
    {
        $user = User::findOrFail($request->id);

        if (Auth::user()->likes->contains($request->id)) {
            Auth::user()->likes()->detach($user->id);
            $like= 2;
        } elseif (!Auth::user()->likes->contains($request->id)) {
            Auth::user()->likes()->attach($user->id);
            $like = 1;
        }

        return response()->json($like);

    }
}
