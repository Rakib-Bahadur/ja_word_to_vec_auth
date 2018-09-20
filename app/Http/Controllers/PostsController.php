<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use File;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'post' => 'required'
        ]);

        $post = new Post;
        $post->title = $request->input('title');
        $post->post = $request->input('post');
        $post->user_id = auth()->user()->id;

        $this->writePostInFileAndTrain($post);
        
        $post->save();

        return redirect('/home')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Check for correct user
        if(auth()->user()->id !== $post->user_id){
            return redirect('/home')->with('error', 'Unauthorized Page');
        }

        $post = Post::find($id);
        return view('posts.edit')->with('post',$post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'post' => 'required'
        ]);

        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->post = $request->input('post');

        $this->writePostInFileAndTrain($post);
        
        $post->save();

        return redirect('/home')->with('success', 'Post Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Check for correct user
        if(auth()->user()->id !== $post->user_id){
            return redirect('/home')->with('error', 'Unauthorized Page');
        }

        $post = Post::find($id);
        $post->delete();
        return redirect('/home')->with('success', 'Post Deleted');
    }

    /**
     * Save All Post on Text File and 
     * Train the Model When File Size Reached 100kb.
     *
     * @param  Post $post
     */

    public function writePostInFileAndTrain(Post $post)
    {
        $post_full_text = $post->title.' '.$post->post;
        $myfile = app_path(). "\\files_word2vec\\user_entry.txt";

        if(File::exists($myfile)){
            File::append($myfile, $post_full_text." ");
            if(filesize($myfile)/1024 >= 100){
                $values = exec("python " . app_path(). "\\files_word2vec\\ja_train_new_data.py ");
            }else{
                $values = "";
            }
        }else{
            File::put($myfile, $post_full_text." ");
            if(filesize($myfile)/1024 >= 100){
                $values = exec("python " . app_path(). "\\files_word2vec\\ja_train_new_data.py ");
            }else{
                $values = "";
            }
        }
    }
}
