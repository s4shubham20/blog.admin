<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Socialmedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $categories = Category::whereHas('post', function ($query){
            $query->where('status', 1);
        })->where('status', 1)->get();
        $socialmedia = Socialmedia::where('status', 1)->get();
        $pages = Page::where('status', 1)->get();
        $setting = Setting::where('id', 1)->first();
        View::share((compact('categories', 'socialmedia', 'pages', 'setting')));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        return view('home');
    }
}
