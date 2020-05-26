<?php

namespace App\Http\Controllers\Auth;

use App\User as User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Get users names.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function names()
    {
        $users = User::select('id', 'name')->get();
        
        return response()->json($users);
    }

    /**
     * Get authenticated user.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function current(Request $request)
    {
        return response()->json($request->user());
    }
}
