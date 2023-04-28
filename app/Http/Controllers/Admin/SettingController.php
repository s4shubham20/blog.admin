<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //return view('back.setting.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Setting::where('id', 1)->first();
        if($data != null){
            $setting = Setting::where('id', 1)->first();
        }else{
            $setting = '';
        }
        return view('back.setting.index', compact('setting'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:settings',
            'url' => 'required|unique:settings',
            'email' => 'required|unique:settings',
            'mobile' => 'required|unique:settings',
            'logo' => 'required|mimes:jpg,jpeg,png,webp|max:2048',
            'fevicon' => 'required|mimes:jpg,jpeg,png,webp|max:2048',
            'robot' => 'required',
            'header' => 'required',
            'footer' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        $setting = new Setting;
        $setting->name      =       $request->name;
        $setting->url       =       $request->url;
        $setting->email     =       $request->email;
        $setting->mobile    =       $request->mobile;
        $setting->robot     =       $request->robot;
        $setting->header    =       $request->header;
        $setting->footer    =       $request->footer;

        if($request->hasFile('logo')){
            $image = $request->file('logo')->getClientOriginalName();
            $imageExt = $request->file('logo')->getClientOriginalExtension();
            $changeLogo = Str::replace($image, (uniqid().'.'.$imageExt), $image);
            $path = 'assets/back/upload/setting/';
            $saveLogo = $path.$changeLogo;
            $request->logo->move(public_path($path), $changeLogo);
            $setting->logo      = $saveLogo;
        }

        if($request->hasFile('fevicon')){
            $image = $request->file('fevicon')->getClientOriginalName();
            $imageExt = $request->file('fevicon')->getClientOriginalExtension();
            $changefevicon = Str::replace($image, (uniqid().'.'.$imageExt), $image);
            $path = 'assets/back/upload/setting/';
            $savefevicon = $path.$changefevicon;
            $request->fevicon->move(public_path($path), $changefevicon);
            $setting->fevicon      = $savefevicon;
        }
        $setting->save();
        return redirect()->back()->with('success', 'Successfully Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //return view('back.setting.index', compact('setting'));
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
    public function update(Request $request, string $eid)
    {
        $id = Crypt::decrypt($eid);
        $setting = Setting::find($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:settings,name,'.$id,
            'url' => 'required|unique:settings,url,'.$id,
            'email' => 'required|unique:settings,email,'.$id,
            'mobile' => 'required|unique:settings,mobile,'.$id,
            'robot' => 'required',
            'header' => 'required',
            'footer' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $setting->name      =       $request->name;
        $setting->url       =       $request->url;
        $setting->email     =       $request->email;
        $setting->mobile    =       $request->mobile;
        $setting->robot     =       $request->robot;
        $setting->header    =       $request->header;
        $setting->footer    =       $request->footer;

        if($request->hasFile('logo')){
            $image = $request->file('logo')->getClientOriginalName();
            $imageExt = $request->file('logo')->getClientOriginalExtension();
            $changeLogo = Str::replace($image, (uniqid().'.'.$imageExt), $image);
            $path = 'assets/back/upload/setting/';
            $saveLogo = $path.$changeLogo;
            $request->logo->move(public_path($path), $changeLogo);
            if(File::exists(public_path($setting->logo))){
                File::delete(public_path($setting->logo));
            }
        }else{
            $saveLogo = $setting->logo;
        }

        if($request->hasFile('fevicon')){
            $image = $request->file('fevicon')->getClientOriginalName();
            $imageExt = $request->file('fevicon')->getClientOriginalExtension();
            $changefevicon = Str::replace($image, (uniqid().'.'.$imageExt), $image);
            $path = 'assets/back/upload/setting/';
            $savefevicon = $path.$changefevicon;
            $request->fevicon->move(public_path($path), $changefevicon);
            if(File::exists(public_path($setting->fevicon))){
                File::delete(public_path($setting->fevicon));
            }
        }
        else{
            $savefevicon = $setting->fevicon;
        }
        $setting->logo      = $saveLogo;
        $setting->fevicon      = $savefevicon;
        $setting->save();
        return redirect()->back()->with('success', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
