<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostImage;
use App\PostType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $posts = Post::all()->where('user_id', $user->id)->sortBy('id', '1', true)->paginate(9);

        return view('post', compact('posts'));
    }

    public function create()
    {
        $postType = new PostType();
        $types = $postType->Types();

        return view('createPost', compact('types'));
    }

    public function store(Request $request)
    {
        $result = $this->validation($request);

        $postData = $this->createModel($request);
        $post = Post::create($postData);

        $this->storeImage($request, $post);
        return redirect('post');
    }

    public function show(Post $post)
    {
        $otherPosts = Post::all()->except($post->id)->paginate(8);

        return view('postDetails', compact('post', 'otherPosts'));
    }

    public function edit(Post $post)
    {
        $postType = new PostType();
        $types = $postType->Types();

        return view('editPost', compact('post', 'types'));
    }

    public function update(Request $request, Post $post)
    {
        $this->validation($request);
        $postData = $this->createModel($request);

        $post->update($postData);
        $this->storeImage($request, $post);
        return redirect('post');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('post');
    }

    public function showAddImage(Post $post){
        $postImages = $post->postImages;

        return view('addImage', compact('postImages', 'post'));
    }

    public function addImage(Request $request, Post $post){

        $this->storeImage($request, $post);

        return redirect('post');
    }

    public function deleteImage(PostImage $postImage){
        $postImage->delete();
        return redirect('post');
    }

    private function validation(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'location' => 'required',
            'description' => 'required|min:10|max:255',
            'rent' => 'required',
            'beds' => 'required',
            'type' => 'required',
        ]);

//        if ($request->hasFile('image')) {
//            $size = $request->file('image')->getSize();
//
//            if ($size >= 10000) {
//                return false;
//            }
//        }
    }

    private function createModel(Request $request)
    {
        $user = Auth::user();
        return array(
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'location' => $request->input('location'),
            'description' => $request->input('description'),
            'rent' => $request->input('rent'),
            'beds' => $request->input('beds'),
            'type' => $request->input('type'),
            'user_id' => $user->id);
    }

    private function storeImage($request, Post $post)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $tmp_name = $image->get('tmp_name');

            $postImage = array('post_id' => $post->id, 'image_data' => base64_encode($tmp_name));

            PostImage::create($postImage);
        }
    }
}
