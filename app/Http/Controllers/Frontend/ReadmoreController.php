<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;

class ReadmoreController extends Controller
{
    public function index(Post $post)
    {
        try {
            $post = Post::with(['comments' => function ($query) {
                $query->orderBy('created_at', 'desc')->with(['replies.user']);
            }, 'comments.user'])
            ->withCount('comments')
            ->where('id', $post->id)
            ->where('status', true)
            ->first();
            
            if (!isset($post)) {
                return back()->with('error', 'No post to display!');
            }
            // recommended post with category in one to many relation
            $recommendedPostWithCategory = Post::latest()->where('category_id', $post->category_id)->where('status', true)
                ->with('category')
                ->get()
                ->slice(1);

            // recommended post with tags with many to many relations
            $postTag = $post->tags()->get();


            $tagIds = $postTag->pluck('id')->toArray();

            $recommendedPostWithTag = Post::latest()->with('tags')->where('status', true)
                ->whereHas('tags', function ($query) use ($tagIds) {
                    $query->whereIn('tag_id', $tagIds);
                })
                ->get();

            // merge post with category and tags and remove the duplicate post
            $recommendedPosts = $recommendedPostWithCategory->concat($recommendedPostWithTag)->unique();

            // fetch all tags
            $tags = Tag::latest()->with('posts')->get();
            return view('frontend.readmore.index', compact('post', 'recommendedPosts', 'tags'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
