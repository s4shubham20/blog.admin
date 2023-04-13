<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\FormRequestSubmit;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('back.admin.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'alt' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg,webp|max:2048',
            'description' => 'required',
            'meta_title' => 'required|max:160',
            'meta_keyword' => 'required|max:200',
            'meta_description' => 'required',
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->alt = $request->alt;
        $category->description = $request->description;
        $category->meta_title = $request->meta_title;
        $category->meta_keyword = $request->meta_keyword;
        $category->meta_description = $request->meta_description;
        $category->status = $request->status;
        $category->created_by = Auth::user()->id;

        if($request->hasFile('image')){
            $imageName = $request->file('image')->getClientOriginalName();
            $imageExt = $request->file('image')->getClientOriginalExtension();
            $changeName = Str::replace($imageName, (uniqid().'.'.$imageExt),$imageName);
            $saveImage = 'assets/back/upload/category/'.$changeName;
            $request->image->move(public_path('assets/back/upload/category'),$changeName);
        }
        $category->image = $saveImage;
        $category->save();
        return redirect()->back()->with('success','Successfully Added');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
