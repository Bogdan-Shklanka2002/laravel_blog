<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all()->where('status' , true);
        return view('post.index', ['posts' => $posts]);
    }

    public function indexByAuthor(){
        $id_author = Auth::user()->id;
        $posts = Post::all()->where('user_id', $id_author);
        return view('post.index', ['posts' => $posts]);
    }
    public function indexByUnpublished(){

       $posts = Post::all()->where('status' , false);
       return view('post.index', ['posts' => $posts]);

    }
    public function indexByAdmin(){
        $posts = Post::all();
        return view('post.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        //dd($request);
        return view('post.create');
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
            'title' => $request->get('title'),
            'body' => $request->get('body'),
            'user_id' => Auth::user()->id,
            'date' => date('d.m.y')
        ]);


        if(!$post){
            return redirect()->back();
        } else{

        }

        $request->session()->flash('flash_message', 'Post is saved');
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.view', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.update', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $post->fill($request->all());
        if($request->get('status') === '0'){
            $post->status = 1;
        }

        if(!$post->save()){
            return redirect()->back();
        } else{

        }
        $request->session()->flash('flash_message', 'Post is updated');
        return redirect()->route('post.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Post $post)
    {
        if($post->delete()){
            $request->session()->flash('flash_message', 'Post is deleted');
            return redirect()->route('post.index');
        } else {
            return redirect()->back();
        }
    }
}
