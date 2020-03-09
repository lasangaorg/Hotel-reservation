<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostImage;

class WelcomeController extends Controller
{
    public function index(){
        $posts = Post::all()->sortBy('id' , 1, false)->paginate(4);
        return view('welcome', compact('posts'));
    }
}
