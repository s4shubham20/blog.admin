<?php

namespace App\Http\Controllers\Admin;

use App\Models\Socialmedia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class SocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $socials = Socialmedia::all();
        return view('back.socialmedia.index' ,compact('socials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.socialmedia.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:socialmedia',
            'url' => 'required|unique:socialmedia',
            'color' => 'required',
            'icon' => 'required',
        ]);

        $social = new Socialmedia;
        $social->name       =       $request->name;
        $social->url        =       $request->url;
        $social->color      =       $request->color;
        $social->icon       =       $request->icon;
        $social->save();

        return redirect()->route('social.index')->with('success', 'Successfully Added');

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
        $social = Socialmedia::find($id);
        return view('back.socialmedia.edit', compact('social'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $eid)
    {
        $id = Crypt::decrypt($eid);
        $request->validate([
            'name' => 'required|unique:socialmedia,name,'.$id,
            'url' => 'required|unique:socialmedia,url,'.$id,
            'color' => 'required',
            'icon' => 'required',
        ]);
        $social = Socialmedia::find($id);
        $social->name       =       $request->name;
        $social->url        =       $request->url;
        $social->color      =       $request->color;
        $social->icon       =       $request->icon;
        $social->status       =       $request->status;
        $social->save();

        return redirect()->back()->with('success', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $eid)
    {
        $id = Crypt::decrypt($eid);
        Socialmedia::destroy($id);
        return redirect()->back()->with('success', 'Successfully Deleted');
    }
}
