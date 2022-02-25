<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function show()
    {
        $post = Post::all();

        return response()->json([
            'success' => true,
            'message' => "Data show successfully",
            'data' => $post
        ]);
    }

    public function index($id)
    {
        $post = Post::find($id);

        return response()->json([
            'success' => true,
            'message' => "Data show successfully",
            'data' => $post
        ]);
    }

    public function store(Request $request)
    {
        $post = new Post();

        $slug = Str::slug($request->title, '-');

        $post->title = $request->title;
        $post->description = $request->description;
        $post->slug = $slug;

        $post->save();

        return response()->json([
            'success' => true,
            'message' => "Data created successfully",
            'data' => $post
        ]);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        $post->title = $request->title;
        $post->description = $request->description;
        $post->slug = $request->slug;

        $post->save();

        return response()->json([
            'success' => true,
            'message' => "Data update successfully",
            'data' => $post
        ]);
    }

    public function delete($id)
    {
        Post::find($id)->delete();

        return response()->json([
            'success' => true,
            'message' => "Data delete successfully",
        ]);
    }
}
