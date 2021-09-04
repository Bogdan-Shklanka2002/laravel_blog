<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostCollection;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ApiPostController extends Controller
{
    public function create(PostRequest $request, $id)
    {
        $user = User::where('id', $id)->first();
        if(!$user){
            return response()->json([
                'status' => 'Error',
                'title' => 'Invalid user ID',
            ]);
        }
        $post = Post::create([
            'title' => $request->get('title'),
            'body' => $request->get('body'),
            'user_id' => $id,
            'date' => date("d.m.y"),
        ]);

        return new PostCollection([$post]);
    }

    //Якщо є ід то він повертає пост з цією ід
    // Якщо нема то він повертає всі пости
    // public function getPost(Request $request)
    // {

    //     if($request->id){
    //         $post = Post::where('id', $request->id)->first();
    //         return response()->json($post);
    //     }
    //     else{
    //         $posts = Post::all();
    //         return response()->json($posts);
    //     }
        
    // }

    public function deletePost(Request $request){
        $post = Post::where('id', $request->get('id'))->first();

        if(!$post){
            return response()->json([
                'status' => 'Error',
                'title' => 'Invalid post ID',
            ]); 
        }

    }
}
