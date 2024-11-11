<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Models\Tag;
use App\Service\TagService;
use Illuminate\Http\Request;

class TagController extends Controller
{
    private $tagService;
    public function __construct() {
        $this->tagService =new TagService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags=Tag::all();
        return view('admin.tags.index',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagRequest $request)
    {
       try{
        $this->tagService->addService($request->except('_token'));
        return redirect()->route('tag.index')->with('success','Tag added successfully');
       }catch(\Throwable $th){
        return back()->with('error',$th->getMessage());

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
    public function edit(Tag $tag)
    {
        return view('admin.tags.edit',compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagRequest $request, Tag $tag)
    {
       try{
        $this->tagService->updateService($request->except('_token','_method'),$tag);
        return redirect()->route('tag.index')->with('success','Tag updated successfully');
       }catch(\Throwable $th){
        return back()->with('error',$th->getMessage());
       }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
       try{
        $this->tagService->deleteService($tag);
        return back()->with('success','Tag deleted successfully');
       }catch(\Throwable $th){
        return back()->with('error',$th->getMessage());
       }
    }
}
