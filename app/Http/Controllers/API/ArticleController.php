<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            "status" => true,
            "data" => Article::latest()->with(['user', 'category'])->paginate(10)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "title" => "required",
            "content" => "required",
            "image" => "required|image|file|max:1024",
            "category_id" => "required"
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }

        if ($request->file('image')) {
            $article = Article::create([
                "title" => $request->title,
                "content" => $request->content,
                "image" => $request->file('image')->store('article-images'),
                "user_id" => $request->user()->id,
                "category_id" => $request->category_id
            ]);
        }

        return response()->json([
            "status" => true,
            "message" => "Article created successfully",
            "data" => $article
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::with(['user', 'category'])->findOrFail($id);
        return response()->json([
            "status" => true,
            "data" => $article
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            "title" => "required",
            "content" => "required",
            "image" => "image|file|max:1024",
            "category_id" => "required"
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }

        $article = Article::findOrFail($id);

        $update = [
            "title" => $request->title,
            "content" => $request->content,
            "category_id" => $request->category_id,
            "user_id" => $request->user()->id,
        ];

        if ($request->file('image')) {
            if ($article->image) {
                Storage::delete($article->image);
            }
            $update['image'] = $request->file('image')->store("article-images");
        }


        Article::where('id', $id)->update($update);

        return response()->json([
            "status" => true,
            "message" => "Article updated successfully"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        if ($article->image) {
            Storage::delete($article->image);
        }

        $res = Article::destroy($article->id);
        if ($res) {
            return response()->json([
                "status" => true,
                "message" => "Category deleted successfully"
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "Category deleted failed"
            ]);
        }
    }
}
