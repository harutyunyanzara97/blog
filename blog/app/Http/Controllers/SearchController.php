<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchBlog(Request $request)
    {
        if ($request->ajax()) {
            $cat = Category::where('title', 'LIKE', '%' . $request->search . "%")->where('category_id',$request->id)->paginate(5);
            if ($cat) {
                return Response($cat);
            }
        }
    }
}
