<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function index()
    {
        $categories = Category::with('children')->get();
        if($categories) {
            return view('admin.home')->with([
                'categories' => $categories
            ]);
        } else {
            return view('admin.home');
        }

    }
}
