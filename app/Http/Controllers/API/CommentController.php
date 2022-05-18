<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $comments = Comment::all();

        return response()->json($comments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCommentRequest $request
     * @return JsonResponse
     */
    public function store(StoreCommentRequest $request)
    {
        $validatedData = $request->validated();
        $comment = new Comment();
        $comment->fill($validatedData)
            ->save();

        return response()->json($comment);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $comment = Comment::findOrFail($id);
        return response()->json($comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreCommentRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(StoreCommentRequest $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $validatedData = $request->validated();

        $comment->fill($validatedData)->save();

        return response()->json($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return response()->json([
            "message" => "Success."
        ]);
    }
}
