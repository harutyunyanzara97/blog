<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {

    }
    public function store(Request $request)
    {
        $category = new Category();
        $category -> user_id = $request->user_id;
        if($request ->parent_id) {
            $category->parent_id = $request->parent_id;
        }
        else{
            $category->parent_id = null;
        }
        $category->name = $request->name;
        $category->save();

        return redirect()->route('category.index');
    }
}
