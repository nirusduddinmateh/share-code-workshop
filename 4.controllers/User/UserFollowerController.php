<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserFollowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($aId)
    {
        $user = User::query()->findOrFail($aId);
        return response()->json([
            'data' => $user->followers
        ]);
    }
}
