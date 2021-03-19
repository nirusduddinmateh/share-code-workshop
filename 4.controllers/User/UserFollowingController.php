<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserFollowingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($aId)
    {
        $post = User::query()->findOrFail($aId);
        return response()->json([
            'data' => $post->following
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $aId
     * @param $bId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $aId, $bId)
    {
        $user = User::query()->findOrFail($aId);
        $user->following()->syncWithoutDetaching([$bId]);

        return response()->json([
            'data' => $user->following
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($aId, $bId)
    {
        $user = User::query()->findOrFail($aId);
        if (!$user->following()->find($bId)) {
            throw new HttpException(404, 'ไม่พบการติดตามที่ระบุของผู้ใช้รายนี้');
        }

        $user->following()->detach($bId);

        return response()->json([
            'data' => $user->following
        ]);
    }
}
