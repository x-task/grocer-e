<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    //


    protected function getPostImageAttribute($value)
    {
        if (strpos($value, 'https://') !== false || strpos($value, 'http://') !== false) {
            return $value;
        }

        return asset('images/' . $value);
    }

    public function index()
    {

        $posts = auth()->user()->posts;
        $posts = Post::all();

        foreach($posts as $post)
        {
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

public function edit(Post $post)
{
    // Authorize's the edit of this post by the logged in user ONLY
    $this->authorize('view', $post);
    return view('admin.posts.edit', ['post' => $post]);
}

public function update(Post $post)
    {
    $input = request()->validate([
        'title' => 'required|min:8|max:255',
         'post_image'=>'file',
          'body' => 'required'
     ]);

     if($file = request('post_image'))
     {
        $name = $file->getClientOriginalName();
        $file->move('images', $name);
        $input['post_image'] = $name;
        $post->post_image = $input ['post_image'];
     }

     $post->title = $input['title'];
     $post->body = $input['body'];

     session()->flash('post-updated-message', 'Post was Updated' .$input['title']);

     /* We authorize the update with the native instance $post so the authorizasion
     can be complete */
     $this->authorize('update', $post);

    // $post->update();    //This is the default update method given by Laravel
     $post->save();     //This updates the post without effecting the ownership
    // auth()->user()->posts()->save($post);  //This changes the owner of the post when updated

     return redirect()->route('post.index');
    }
}


