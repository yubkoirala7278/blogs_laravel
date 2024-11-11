<?php

namespace App\Service;

use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostService
{
    private $imageService;
    public function __construct()
    {
        $this->imageService = new ImageService();
    }

    // ===========POST(Add)=================
    public function addService($request)
    {
        // adding data in parent table
        $post = Post::create([
            'user_id' => auth()->id(),
            'category_id' => $request['category'],
            'title' => $request['title'],
            'description' => $request['description'],
            'status' => $request['status'],
        ]);
        // if image exist
        if (isset($request['image'])) {
            $this->imageService->saveImage($post, $request['image'], 'post');
        }
        // add data with many to many relation
        $post->tags()->attach($request['tags']);
        return $post;
    }
    // =====================================

    // ==============GET All==================
    public function fetchPost()
    {
        $posts = Post::latest()->with(['category', 'tags', 'image'])->paginate(10);
        return $posts;
    }
    // =======================================

    // =========fetch single post===========
    public function view($post)
    {
        $post = Post::with(['category', 'tags', 'image'])->first();
        return $post;
    }
    // =====================================

    // ===========UPDATE POST==============
    public function updateService($request, $post)
    {
        // update image
        if (!empty($request['filename'])) {
            $this->imageService->updateImage($post, $request['filename'], 'post', true);
        }
        // updating data in parent table
        $post->update([
            'user_id' => auth()->id(),
            'category_id' => $request['category'],
            'title' => $request['title'],
            'description' => $request['description'],
            'status' => $request['status'],
        ]);
        // updating data with many to many relation
        $post->tags()->sync($request['tags']);
    }
    // ====================================

    // =============DELETE=================
    public function deletePost($post)
    {
        if (!empty($post['image'])) {
            $this->imageService->deleteImage($post['image']);
        }
        //if not used cascadeOnDelete() then you should detach from many to many relation else you can directly use delete only
        $post->tags()->detach();
        $post->delete();
    }
    // ====================================
}
