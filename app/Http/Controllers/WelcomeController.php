<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostImage;
use App\PostType;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(){
        $posts = Post::all()->sortBy('id' , 1, false)->paginate(4);
        $postType = new PostType();
        $types = $postType->Types();
        return view('welcome', compact('posts', 'types'));
    }

    public function search(Request $request){

        $postType = new PostType();
        $types = $postType->Types();

        $type = $request->input('type');
        $location = $request->input('location');

        $posts = Post::all();

        if ($location != null){
            $posts = Post::where('location', 'LIKE', '%'.$location.'%')->paginate(4);
        }

        if ($type != null && $type != "0"){
            $posts = Post::where('type', 'LIKE', '%'.$type.'%')->paginate(4);
        }

        if ($location == null &&  $type == "0"){
            $posts = Post::all()->paginate(4);
        }

        return view('welcome', compact('posts', 'types'));
    }
}
