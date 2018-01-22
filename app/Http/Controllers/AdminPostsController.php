<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('author')->get();
        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name','id')->all();
        return view('admin.posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post;
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;

        //create the post
        $newPostId = $post->create($input)->id;
        $createdPost = Post::find($newPostId);

        //if categories sync them to the post
        if($request->cats){
            $createdPost->categories()->sync($request->cats);
        }

        //if post image upload it
        if($fileData = $request->file('photo_id')){
           $fileName = $fileData->getClientOriginalName();
           $fileSaveData =  $fileData->store('post-photos','public');
           $createdPost->files()->create(['path'=>$fileSaveData,'filename'=>$fileName]);
        }

       return redirect('/admin/posts/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post = Post::findOrFail($post->id);
        $comments = $post->comments;
        return view('admin.comments.show',compact('comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::pluck('name','id')->all();
        return view('admin.posts.edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());

         //if categories sync them to the post
        if($request->cats){
            $post->categories()->sync($request->cats);
        }

        if($fileData = $request->file('photo_id')){
           $fileName = $fileData->getClientOriginalName();
           $fileSaveData =  $fileData->store('post-photos','public');
           $post->files()->create(['path'=>$fileSaveData, 'filename'=>$fileName]);
        }
        
        return redirect('/admin/posts'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if($post->files->last()){
            $file = $post->files->last()->path;
            Storage::disk('public')->delete(str_replace('/storage/','',$file));
            $post->files()->delete();
        }

        $post->categories()->detach();
        $post->delete();

        
        Session::flash('deleted_post','The post has been deleted!');
        return redirect('/admin/posts');
    }

    public function post($id){

        $post = Post::findOrFail($id);
        
        return view('post',compact('post'));


    }
}
