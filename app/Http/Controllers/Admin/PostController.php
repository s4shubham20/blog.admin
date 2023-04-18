<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\{Post,Category};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category')->get();
        return view('back.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view('back.post.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:posts',
            'slug' => 'required|unique:posts',
            'alt' => 'required',
            'image' => 'required|mimes:png,jpg,webp,jpeg|max:2048',
            'category' => 'required',
            'status' => 'required',
            'description' => 'required',
            'yt_iframe' => 'required',
            'meta_title' => 'required',
            'meta_keyword' => 'required',
            'meta_description' => 'required',

        ]);

        $post = new Post;
        $post->name = $request->name;
        $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $request->slug); //Removed all Special Character and replace with hyphen
        $final_slug = preg_replace('/-+/', '-', $string); //Removed double hyphen
        $slug = strtolower($final_slug);
        $post->slug = $slug;
        $post->alt = $request->alt;
        $post->yt_iframe = $request->yt_iframe;
        $post->category_id = $request->category;
        $post->status = $request->status;
        $post->description = $request->description;
        $post->meta_title = $request->meta_title;
        $post->meta_keyword = $request->meta_keyword;
        $post->meta_description = $request->meta_description;
        $post->created_by = Auth::user()->id;

        if($request->hasFile('image')){
            $imageName = $request->file('image')->getClientOriginalName();
            $imageExt = $request->file('image')->getClientOriginalExtension();
            $path = 'assets/back/upload/post/';
            $saveImage = Str::replace($imageName ,(uniqid().'.'.$imageExt), $imageName);
            $saveImageDb = Str::replace($imageName ,($path.$saveImage), $imageName);
            $request->image->move(public_path($path), $saveImage);
        }
        $post->image = $saveImageDb;
        $post->save();
        return redirect('admin/post')->with('success','Successfully Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $eid)
    {
        $id = Crypt::decrypt($eid);
        $categories = Category::all();
        $post = Post::with('category')->find($id);
        return view('back.post.edit', compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $eid)
    {
        $id = Crypt::decrypt($eid);
        $request->validate([
            'name' => 'required|unique:posts,name,'.$id,
            'slug' => 'required|unique:posts,slug,'.$id,
            'alt' => 'required',
            'category' => 'required',
            'status' => 'required',
            'description' => 'required',
            'yt_iframe' => 'required',
            'meta_title' => 'required',
            'meta_keyword' => 'required',
            'meta_description' => 'required',

        ]);

        $post = Post::findOrFail($id);
        $post->name = $request->name;
        $post->slug = Str::slug($request->slug);
        $post->alt = $request->alt;
        $post->yt_iframe = $request->yt_iframe;
        $post->category_id = $request->category;
        $post->status = $request->status;
        $post->description = $request->description;
        $post->meta_title = $request->meta_title;
        $post->meta_keyword = $request->meta_keyword;
        $post->meta_description = $request->meta_description;

        if($request->hasFile('image')){
            $imageName = $request->file('image')->getClientOriginalName();
            $imageExt = $request->file('image')->getClientOriginalExtension();
            $path = 'assets/back/upload/post/';
            $saveImage = Str::replace($imageName ,(uniqid().'.'.$imageExt), $imageName);
            $saveImageDb = Str::replace($imageName ,($path.$saveImage), $imageName);
            $request->image->move(public_path($path), $saveImage);
            if(File::exists(public_path($post->image))){
                File::delete(public_path($post->image));
            }
        }else{
            $saveImageDb = $post->image;
        }
        $post->image = $saveImageDb;

        $post->save();
        return redirect()->back()->with('success','Successfully Updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $eid)
    {
        $id = Crypt::decrypt($eid);
        $post = Post::findOrFail($id);
        if(File::exists(public_path($post->image))){
            File::delete(public_path($post->image));
        }
        Post::destroy($id);
        return redirect()->back()->with('success','Successfully Deleted');

    }

    public function deleteall(Request $request)
    {
        $deleteId = $request->ids;
        $post = Post::whereIn('id', explode(",",$deleteId))->get();
        foreach ($post as $key => $item) {
            if(File::exists(public_path($item->image))){
                File::delete(public_path($item->image));
            }
        }
        Post::whereIn('id',explode(",",$deleteId))->delete();;
        return redirect()->back()->with('success', 'Successfully Deleted');
    }
}
