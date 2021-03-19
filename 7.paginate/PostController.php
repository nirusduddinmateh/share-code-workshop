<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Transformers\PostTransformer;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $posts = Post::query()->paginate();
        $posts = fractal($posts, new PostTransformer())->toArray();
        return response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $rules = [
            'title'  => 'required',
            'description' => 'required'
        ];

        $this->validate($request, $rules);

        $post = Post::query()->create($request->all());

        return response()->json([
            'data' => $post
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $post = Post::query()->findOrFail($id);
        return response()->json([
            'data' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $post = Post::query()->findOrFail($id);

        $post->fill($request->all());

        if (!$post->isDirty()) {
            return response()->json([
                'error' => 'คุณจำเป็นต้องระบุค่าที่แตกต่างเพื่อการปรับปรุงข้อมูล!',
                'code'  => 422
            ], 422);
        }

        $post->save();

        return response()->json([
            'data' => $post
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $post = Post::query()->findOrFail($id);

        $post->delete();

        return response()->json([
            'deleted' => true,
            'data' => $post
        ]);
    }
}
