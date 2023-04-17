<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('role',0)->get();
        return view('back.user.index', compact('user'));
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
        //
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
        $user = User::where('role', '!=', 1)->findOrFail($id);
        return view('back.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $eid)
    {
        $id = Crypt::decrypt($eid);
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id
        ]);
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password != ""){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect()->back()->with('success', 'You have successfully updated !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $eid)
    {
        $id = Crypt::decrypt($eid);
        $user = User::destroy($id);
        return redirect()->back()->with('success', 'You have successfully deleted !');
    }
}
