<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkCategory')->only('create');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts',Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories', Category::all())->with('tags' , Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = Post::create([
            'titel'=> $request->titel,
            'description'=>$request->description,
            'content'=>$request->content,
            'image'=>$request->image->store('images', 'public'),
            'category_id'=>$request->categoryId
        ]);
        if($request->tag)
        {
            $post->tags()->attach($request->tag);
        }

        session()->flash('success', 'Created Post Successfully');
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('post' , $post)->with('categories' , Category::all())->with('tags' , Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->titel = $request->titel;
        $post->description = $request->description;
        $post->content = $request->content;
        if ($request->hasFile('image')) {
            $image = $request->image->store('images', 'public');
            Storage::disk('public')->delete($post->image);
            $post->image = $image;
        }
        if($request->tag)
        {
            $post->tags()->sync($request->tag);
        }
        $post->save();
        session()->flash('success' , 'Post Updated Succesfully');
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $post = Post::withTrashed()->where('id' , $id)->first();
            if($post->trashed())
            {
                $post->forceDelete();
                Storage::disk('public')->delete($post->image);

            }else{
                $post->delete();
            }
            session()->flash('success', 'Post trashed Successfully');
            return redirect(route('posts.index'));
    }

    public function trashed()
    {
        $trashed = Post::onlyTrashed()->get();
        return view('posts.index')->with('posts',$trashed);
    }
    public function restore($id)
    {
        Post::withTrashed()
                        ->where('id' , $id)
                        ->restore();
        session()->flash('success', 'Post Restore Successfully');
        return redirect(route('posts.index'));
    }
}
