<?php

namespace App\Http\Controllers\front;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        if(Auth::check()){
            $validator = Validator::make($request->all(), [
                'comment' => 'required|string'
            ]);
            if($validator->fails()){
                return redirect()->back()->with('error', 'This can\'t be empty');
            }
            $post = Post::where('slug', $request->post_slug)->where('status', 1)->first();
            if($post){
                Comment::create([
                    'post_id' => $post->id,
                    'user_id' => Auth::user()->id,
                    'comment' => $request->comment,
                ]);
            return redirect()->back()->with('success', 'Successfully Posted !');
            }else{
            return redirect()->back()->with('error', 'No Such Post Availabel !');
            }
        }else{
            return redirect('login')->with('error', 'Please login first !');
        }
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
    public function destroy(Request $request)
    {
        $id = Crypt::decrypt($request->commentId);
        if(Auth::check()){
            $comment = Comment::where('id',$id)
                        ->where('user_id', Auth::user()->id)
                        ->first();
            if($comment){
                $comment->delete();
                return response()->json([
                    'status' => 200,
                    'message' => 'Comment Successfully Deleted!'
                ]);
            }
        }else{
            return response()->json([
                'status' => 401,
                'message' => 'Login to delete this comment?'
            ]);
        }
    }
}
