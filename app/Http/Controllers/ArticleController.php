<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('article.index', [
            "articles" => Article::latest()->with(['user', 'category'])->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('article.create', [
            "category" => Category::all(['id', 'name'])
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
        $validate = $request->validate([
            'title' => 'required',
            'image' => 'required|image|file|max:1024',
            'category_id' => 'required',
            'content' => 'required'
        ]);
        $validate["user_id"] = $request->user()->id;

        if ($request->file('image')) {
            $validate['image'] = $request->file('image')->store("article-images");
        }

        $res = Article::create($validate);
        if ($res) {
            Alert::success("Success", "Article created successfully");
            return redirect('/admin/articles');
        } else {
            Alert::success("Upps", "Article created failed");
            return redirect()->back();
        }
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
        return view('article.show', ["article" => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::with('category')->findOrFail($id);
        $category = Category::all(['id', 'name']);

        return view('article.edit', [
            "article" => $article,
            "category" => $category
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
        $validate = $request->validate([
            'title' => 'required',
            'image' => 'image|file|max:1024',
            'category_id' => 'required',
            'content' => 'required'
        ]);

        $validate["user_id"] = $request->user()->id;

        $article = Article::findOrFail($id);

        if ($request->file('image')) {
            if ($article->image) {
                Storage::delete($article->image);
            }
            $validate['image'] = $request->file('image')->store("article-images");
        }

        $res = Article::where('id', $id)->update($validate);
        if ($res) {
            Alert::success("Success", "Article updated successfully");
            return redirect('/admin/articles');
        } else {
            Alert::success("Upps", "Article updated failed");
            return redirect()->back();
        }
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
            Alert::success("Success", "Article deleted successfully");
            return redirect('/admin/articles');
        } else {
            Alert::success("Upps", "Article deleted failed");
            return redirect()->back();
        }
    }
}
