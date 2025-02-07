<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{

    public function deletePost(Post $post){
        if(auth()->guard()->user()->id === $post['user_id']){
            $post->delete();
        }
        return redirect('/');

    }

    public function updatePost(Post $post, Request $request){

        if(auth()->guard()->user()->id !== $post['user_id']){
            return redirect('/');
        }
        $incomeField = $request->validate([
            'title'=>'required',
            'body'=>'required',
        ]);
        
        $incomeField['title']= strip_tags($incomeField['title']);
        $incomeField['body']= strip_tags($incomeField['body']);

        $post->update($incomeField);
        return redirect('/');
    }

    public function editScreen(Post $post){
        if(auth()->guard()->user()->id !== $post['user_id']){
            return redirect('/');
        }
        return view('edit-post', ['post' => $post]);
    }
    
    public function createPost(Request $request){
        $incomeField = $request->validate([
            'title'=>'required',
            'body'=>'required',
        ]);

        $incomeField['title']= strip_tags($incomeField['title']);
        $incomeField['body']= strip_tags($incomeField['body']);
        $incomeField['user_id'] = auth()->guard()->id();
        Post::create($incomeField);
        return redirect('/');
    }
}
