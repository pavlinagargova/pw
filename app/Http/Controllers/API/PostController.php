<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePostRequest $request
     * @return JsonResponse
     */
    public function store(StorePostRequest $request)
    {
        $validatedData = $request->validated();

        $post = new Post([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'author_id' => $validatedData['author_id']
        ]);

        $post->save();

        $post->tags()->sync($validatedData['tags']);
        // attach image to post here

        return response()->json($post->load('tags'));
    }

    /**
     * Display the specified resource.
     *
     * @return JsonResponse
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $post->with('tags')
            ->with('comments')
            ->get();

        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StorePostRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(StorePostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $validatedData = $request->validated();

        $post->fill($validatedData)->save();

        $post->tags()->sync($validatedData['tags']);

        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json([
            "message" => "Success."
        ]);
    }
}
