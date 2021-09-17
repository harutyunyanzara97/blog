<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function likeBlog(Request $request)
    {
        $blog = Blog::findOrFail($request->id);

        if (Auth::user()->liking_blogs->contains($request->id)) {
            Auth::user()->liking_blogs()->detach($blog->id);
            $like = 2;
        } elseif (!Auth::user()->liking_blogs->contains($request->id)) {
            Auth::user()->liking_blogs()->attach($blog->id);
            $like = 1;
        }


        return response()->json($like);

    }
    public function store(Request $request)
    {
        $blog = new Blog();
        $blog->name = $request->name;
        $blog->description = $request->description;
        $blog->user_id=Auth::id();
        $blog->save();

        $blog->categories()->attach($request->categories_id);
        if ($request->hasfile('photo')) {
            $image=$request->photo;
            $name = time() . $image->getClientOriginalName();
            $image->move(public_path() . '/images/', $name);
            $blog->photo=$name;
        }
        $blog->save();

        return redirect()->back();
    }
    public function searchCategory(Request $request) {
        if ($request->ajax()) {
            $category = Category::where('name', 'LIKE', '%' . $request->search . "%")->with('blogs')->paginate(5);
            if ($category) {
                return Response($category);
            }
        }
    }


}
