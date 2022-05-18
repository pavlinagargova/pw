<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $tags = Tag::all();

        return response()->json($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTagRequest $request
     * @return JsonResponse
     */
    public function store(StoreTagRequest $request)
    {
        $validatedData = $request->validated();
        $tag = new Tag();
        $tag->fill($validatedData)
            ->save();

        return response()->json($tag);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $tag = Tag::findOrFail($id);
        return response()->json($tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreTagRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(StoreTagRequest $request, $id)
    {
        $tag = Tag::findOrFail($id);
        $validatedData = $request->validated();

        $tag->fill($validatedData)->save();

        return response()->json($tag);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return response()->json([
            "message" => "Success."
        ]);
    }

    public function filter($id): JsonResponse
    {
        $relatedPosts = Post::query()
            ->whereHas('tags', function($query) use ($id){
               $query->where('id', $id);
            })
            ->get();

        return response()->json($relatedPosts);
    }
}
