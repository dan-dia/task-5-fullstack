<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
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
            "data" => Category::latest()->with('user')->paginate(10)
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
            "name" => "required|unique:categories"
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }

        $category = Category::create([
            "name" => $request->name,
            "user_id" => $request->user()->id
        ]);

        return response()->json([
            "status" => true,
            "message" => "Category created successfully",
            "data" => $category
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
        $category = Category::with('user')->findOrFail($id);
        return response()->json([
            "status" => true,
            "data" => $category
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
            "name" => "required|unique:categories"
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }

        Category::where('id', $id)->update([
            "name" => $request->name,
            "user_id" => $request->user()->id
        ]);

        return response()->json([
            "status" => true,
            "message" => "Category updated successfully"
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
        $res = Category::destroy($id);
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
