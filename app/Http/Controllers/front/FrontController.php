<?php

namespace App\Http\Controllers\front;

use App\Models\{Category,Post};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use view;
class FrontController extends Controller
{

    public function __construct()
    {
        //$categories = Category::where('status', 1)->get();
        //share(view(compact('categories')));
    }

    public function index()
    {
        return view('front.index');
    }

    public function post($slug)
    {
        $category = Category::where('slug', $slug)->where('status', 1)->first();
        if($category)
        {
            $post = Post::where('category_id', $category->id)->where('status', 1)->paginate(5);
            return view('front.post.index', compact('post', 'category'));
        }
        else
        {
            return redirect('/');
        }
    }

    public function postdetail($slug1, $slug2)
    {
        $category = Category::where('slug', $slug1)->where('status',1)->first();
        if($category)
        {
            $post = Post::where('category_id', $category->id)->where('slug', $slug2)->where('status', 1)->first();
            return view('front.post.postdetail', compact('post'));
        }
        else{

        }
    }
}
