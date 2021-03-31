<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    //


    protected function getPostImageAttribute($value) {
        if (strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) {
            return $value;
        }
        return asset('images/' . $value);
    }

    public function index(){

        $posts = Post::all();

        foreach($posts as $post){
            $post->post_image = $this->getPostImageAttribute($post->post_image);
        }

        return view('admin.posts.index', ['posts' => $posts]);
    }


    public function show(Post $post){



        return view('blog-post', ['post'=> $post]);

    }

    public function create(){

        return view('admin.posts.create');
    }

//     public function store(){

//         $inputs = request()->validate([
//             'title'=>'required|min:8|max:255',
//             'post_image'=>'file',
//             'body'=>'required'

//          ]);
//     if(request('post_image')){
//         $inputs['post_image'] = request('post_image')->store('images');
//     }
//     //dd($request->post_image);
//     auth()->user()->posts()->create($inputs);
//     return back();

//     }
public function store(){

    $input = request()->validate([
      'title' => 'required|min:8|max:255',
       'post_image'=>'file',
        'body' => 'required'
   ]);

  if($file = request('post_image')){

       $name = $file->getClientOriginalName();
        $file->move('images', $name);
        $input['post_image'] = $name;
    }
    auth()->user()->posts()->create($input);
    session()->flash('post-created-message', 'Post was Created');
    return redirect()->route('post.index');
}


public function destroy(Post $post){
    $post->delete();
    Session::flash('message', 'Post was deleted');
    return back();
}
}


