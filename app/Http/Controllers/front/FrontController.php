<?php

namespace App\Http\Controllers\front;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Models\{Category,Post,Socialmedia,Newsletter,Setting};

class FrontController extends Controller
{

    public function __construct()
    {

        $categories = Category::whereHas('post', function ($query){
            $query->where('status', 1);
        })->where('status', 1)->get();
        $socialmedia = Socialmedia::where('status', 1)->get();
        $pages = Page::where('status', 1)->get();
        $setting = Setting::where('id', 1)->first();
        View::share((compact('categories', 'socialmedia', 'pages', 'setting')));
    }

    public function index()
    {
        $category = Category::whereHas('post', function ($query){
            $query->where('status',1);
        })->where('status',1)->latest('id')->get();
        $latestpost = Post::whereHas('category', function ($query){
            $query->where('status',1);
        })->where('status',1)->latest('id')->get()->take(5);
        return view('front.index', compact('category','latestpost'));
    }

    public function post($slug)
    {
        $category = Category::where('slug', $slug)->where('status', 1)->first();
        $count = Post::withCount('category')->where('status', 1)->where('category_id', $category->id)->get();
        if($category)
        {
            $post = Post::where('category_id', $category->id)->where('status', 1)->paginate(5);
            $meta = [
                'metatitle' => $category->meta_title,
                'metakeyword' => $category->meta_keyword,
                'metadescription' => $category->meta_description,
            ];
            return view('front.post.index', compact('post', 'category', 'meta', 'count'));
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
            $recentpost = Post::where('category_id' , $category->id)->where('id' , '!=' , $post->id)->latest()->take(5)->where('status', 1)->get();
            if($post){
                $meta = [
                    'metatitle' => $post->meta_title,
                    'metakeyword' => $post->meta_keyword,
                    'metadescription' => $post->meta_description,
                ];
                return view('front.post.postdetail', compact('post', 'recentpost', 'meta'));
            }
            return view('front.post.postdetail', compact('post', 'recentpost'));
        }

    }

    public function newsletter(Request $ajaxrequest)
    {
        $ajaxrequest->validate([
            'email'         => 'required|email|unique:newsletters',
        ]);
        $newsletter = new Newsletter;
        $newsletter->email      = $ajaxrequest->email;
        $saveNewsletter = $newsletter->save();
        if($saveNewsletter){
            return response()->json([
                'status'  => 200,
                'success' => 'Successfully'
            ]);
        }else{
            return response()->json([
                'status'  => 401,
                'error' => 'Something went wrong'
            ]);
        }
    }

    public function pagedetail($slug)
    {
        $pagedetail = Page::where('status', 1)->where('slug', $slug)->first();
        if($pagedetail){
            $meta = [
                'metatitle' => $pagedetail->metatitle,
                    'metakeyword' => $pagedetail->metakeyword,
                    'metadescription' => $pagedetail->metadescription,
            ];
            return view('front.page.pagedetail', compact('pagedetail', 'meta'));
        }
        return view('front.page.pagedetail', compact('pagedetail'));
    }
}
