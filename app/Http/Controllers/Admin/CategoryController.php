<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\Admin\FormRequestSubmit;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();

        return view('back.category.index', ['categories' => $category]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FormRequestSubmit $request)
    {
        $request->validated();
        $category = new Category;
        $category->name = $request->name;
        $category->slug = Str::replace(' ', '-', $request->slug);
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
    public function edit(string $eid)
    {
        $id = Crypt::decrypt($eid);
        $category = Category::find($id);
        return view('back.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $eid)
    {
        $id =Crypt::decrypt($eid);
        $request->validate([
            'name' => 'required|unique:categories,name,'.$id,
            'slug' => 'required|unique:categories,slug,'.$id,
            'alt' => 'required',
            'description' => 'required',
            'meta_title' => 'required',
            'meta_keyword' => 'required',
            'meta_description' => 'required'
        ]);

        $category = Category::find($id);

        if($request->image != null){
            $imageName = $request->file('image')->getClientOriginalName();
            $imageExt = $request->file('image')->getClientOriginalExtension();
            $changeName = Str::replace($imageName, (uniqid().'.'.$imageExt),$imageName);
            $saveImage = 'assets/back/upload/category/'.$changeName;
            $request->image->move(public_path('assets/back/upload/category'),$changeName);
            if(File::exists(public_path($category->image))){
                File::delete(public_path($category->image));
            }
        }else{
            $saveImage = $category->image;
        }

        $category->name                 =       $request->name;
        $category->slug                 =       $request->slug;
        $category->image                =       $saveImage;
        $category->alt                  =       $request->alt;
        $category->status               =       $request->status;
        $category->description          =       $request->description;
        $category->meta_title           =       $request->meta_title;
        $category->meta_keyword         =       $request->meta_keyword;
        $category->meta_description     =       $request->meta_description;
        $category->save();
        return redirect()->back()->with('success', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $eid)
    {
        $id = Crypt::decrypt($eid);
        $category = Category::find($id);
        if(File::exists(public_path($category->image))){
            File::delete(public_path($category->image));
        }
        $category->destroy($id);
        return redirect()->back()->with('success', 'Successfully Deteled !');
    }
}
