<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function store(Request $request){
        $category = new Category;
        $category->name = $request->input('name');
        $category->user_id = Auth::user()->id;
        $category->save();

        return response()->json(['category' => $category], 201);
    }

    public function list(Request $request){
        $categories = Category::where('user_id', $request->input('user_id'))->get();
        return response()->json(['categories' => $categories]);
    }
}
