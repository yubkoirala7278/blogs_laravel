<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(Tag $tag){
        // fetch posts with selected tag
        $posts = Post::latest()->with('tags')->where('status',true)->whereHas('tags',function ($query) use ($tag){
            $query->whereIn('tag_id',$tag);
        })->paginate(10);

         //    fetch tags with counts
         $tags = Tag::latest()->with('posts')->get();
        return view('frontend.tag.index',compact('posts','tags'));
    }
}
