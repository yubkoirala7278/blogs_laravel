<?php

namespace App\Http\Controllers\Frontend;

use App\Events\ContactFormSubmitted;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        //=====fetch post with category,tags and image relation======
        $posts = Post::latest()->with(['category', 'tags', 'image'])->where('status', true)->paginate(10);

        //========fetch categories with counts======
        // $categories = Category::latest()->withCount('posts')->get();
        $categories = Category::latest()
            ->withCount(['posts' => function (Builder $query) {
                $query->where('status', true);
            }])
            ->get();



        //=======fetch all tags with counts=========
        // $tags = Tag::latest()->withCount('posts')->get();
        $tags = Tag::latest()
            ->withCount(['posts' => function (Builder $query) {
                $query->where('status', true);
            }])
            ->get();

        return view('frontend.home.index', compact('posts', 'tags', 'categories'));
    }

    public function aboutAuthor()
    {
        $tags = Tag::latest()->withCount('posts')->get();
        $categories = Category::latest()->withCount('posts')->get();
        return view('frontend.about_author.index', compact('tags', 'categories'));
    }

    public function contactUs()
    {
        //    fetch all tags with counts
        $tags = Tag::latest()->withCount('posts')->get();
        return view('frontend.contact_us.index', compact('tags'));
    }

    public function contact(ContactRequest $request)
    {
        try {
            $contact = Contact::create($request->validated());
            event(new ContactFormSubmitted($contact));
            return back()->with('success', 'Thank you for the message!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
