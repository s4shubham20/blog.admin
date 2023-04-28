<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Crypt;

class PageController extends Controller
{

    public function __construct()
    {
        $setting = Setting::where('id', 1)->first();
        View::Share(compact('setting'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Page::all();
        return view('back.page.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.page.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return $request;
        $request->validate([
            'name' => 'required|unique:pages',
            'slug' => 'required|unique:pages',
            'image' => 'required|mimes:jpg,webp,jpeg,png|max:2048',
            'alt' => 'required',
            'status' => 'required',
            'description' => 'required',
            'metatitle' => 'required',
            'metakeyword' => 'required',
            'metadescription' => 'required'
        ]);
        $page = new Page;
        $page->name             = Str::lower($request->name);
        $page->slug             = Str::slug($request->slug);
        $page->alt              = $request->alt;
        $page->status           = $request->status;
        $page->description      = $request->description;
        $page->metatitle        = $request->metatitle;
        $page->metakeyword      = $request->metakeyword;
        $page->metadescription  = $request->metadescription;

        if($request->hasFile('image')){
            $imageName = $request->file('image')->getClientOriginalName();
            $imageExt = $request->file('image')->getClientOriginalExtension();
            $replaceName = Str::replace($imageName, (uniqid().'.'.$imageExt),$imageName);
            $path = 'assets/back/upload/page/';
            $saveImage = $path.$replaceName;
            $request->image->move(public_path($path),$replaceName);
            $page->image            =       $saveImage;
        }

        $page->save();
        return redirect()->route('page.index')->with('success', 'Successfully Added');
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
        $page = Page::findOrFail($id);
        return view('back.page.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $eid)
    {
        $id = Crypt::decryptString($eid);
        $page = Page::find($id);
        $request->validate([
            'name' => 'required|unique:pages,name,'.$id,
            'slug' => 'required|unique:pages,slug,'.$id,
            'alt' => 'required',
            'status' => 'required',
            'description' => 'required',
            'metatitle' => 'required',
            'metakeyword' => 'required',
            'metadescription' => 'required'
        ]);
        $page->name             = Str::lower($request->name);
        $page->slug             = Str::slug($request->slug);
        $page->alt              = $request->alt;
        $page->status           = $request->status;
        $page->description      = $request->description;
        $page->metatitle        = $request->metatitle;
        $page->metakeyword      = $request->metakeyword;
        $page->metadescription  = $request->metadescription;

        if($request->hasFile('image')){
            $imageName = $request->file('image')->getClientOriginalName();
            $imageExt = $request->file('image')->getClientOriginalExtension();
            $replaceName = Str::replace($imageName, (uniqid().'.'.$imageExt),$imageName);
            $path = 'assets/back/upload/page/';
            $saveImage = $path.$replaceName;
            $request->image->move(public_path($path),$replaceName);
            if(File::exists(public_path($page->image))){
                File::delete(public_path($page->image));
            }
        }else{
            $saveImage = $page->image;
        }
        $page->image            =       $saveImage;
        $page->save();
        return redirect()->back()->with('success', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $eid)
    {
        $id = Crypt::decrypt($eid);
        $page = Page::find($id);
        if(File::exists(public_path($page->image))){
            File::delete(public_path($page->image));
        }
        Page::destroy($id);
        return redirect()->back()->with('success', 'Successfully Deleted');
    }
}
