<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\CommentReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'comment' => 'required|string',
        ]);
        try {
            if (!Auth::user()) {
                return redirect()->back()->with('error', 'Please login to comment!!');
            }

            Comment::create([
                'post_id' => $request->post_id,
                'user_id' => auth()->id(),
                'comment' => $request->comment,
            ]);
            return redirect()->back()->with('success', 'Comment posted successfully!!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function reply(Request $request, Comment $comment)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);
        try {
            if (!Auth::user()) {
                return back()->with('error', 'Please login to reply this comment!!');
            }
            Comment::create([
                'post_id' => $comment->post_id,
                'user_id' => auth()->id(),
                'comment_id' => $comment->id,
                'comment' => $request->comment,
            ]);
            return back()->with('success', 'Your reply has been posted successfully!!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function delete($id){
        try{
            Comment::where('id',$id)->delete();
            return back()->with('success','Comment deleted successfully!');
        }catch(\Throwable $th){
            return back()->with('error',$th->getMessage());
        }
    }

    public function deleteReply($id,$commentId){
        try{
            Comment::where('id',$id)->where('comment_id',$commentId)->delete();
            return back()->with('success','Comment deleted successfully!');
        }catch(\Throwable $th){
            return back()->with('error',$th->getMessage());
        }
    }
}
