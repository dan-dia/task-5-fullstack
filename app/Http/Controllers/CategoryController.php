<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class CategoryController extends Controller
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
        $categories = Category::latest()->with('user')->paginate(10);
        return view('category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
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
            "name" => "required|unique:categories"
        ]);

        $validate['user_id'] = $request->user()->id;

        $res = Category::create($validate);

        if ($res) {
            Alert::success('Success', 'Category created successfully');
            return redirect('/admin/categories');
        } else {
            Alert::error('Upss!', 'Category created failed');
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
        $category = Category::with('user')->findOrFail($id);
        return view('category.show', ["category" => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::with('user')->findOrFail($id);
        return view('category.edit', ["category" => $category]);
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
            "name" => "required|unique:categories"
        ]);

        $validate['user_id'] = $request->user()->id;

        $res = Category::where('id', $id)->update($validate);

        if ($res) {
            Alert::success('Success', 'Category updated successfully');
            return redirect('/admin/categories');
        } else {
            Alert::error('Upss!', 'Category updated failed');
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
        $res = Category::destroy($id);

        if ($res) {
            Alert::success('Success', 'Category deleted successfully');
            return redirect('/admin/categories');
        } else {
            Alert::error('Upss!', 'Category deleted failed');
            return redirect()->back();
        }
    }
}
