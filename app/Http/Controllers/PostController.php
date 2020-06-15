<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{

    public function index() {


        // $posts = auth()->user()->posts()->paginate(5);
        
        $posts = Post::all();

        return view('admin.posts.index', ['posts' => $posts]);

    
    }

    
    public function show(Post $post) {


        return view('blog-post', ['post' => $post]);
    }

    public function create() {

        $this->authorize('create', Post::class);

        return view('admin.posts.create');
        
    }

    public function store(Request $request) {

        $this->authorize('create', Post::class);


        $inputs = request()->validate([
            'title' => 'required|min:8|max:255',
            'post_image' => 'file|required',
            'body' => 'required',
        ]);

        if(request('post_image')) {
            $inputs['post_image'] = request('post_image')->store('images');
        }

        auth()->user()->posts()->create($inputs);

        session()->flash('post-create-message', 'Post was created with tile : '. $inputs['title']);

        return redirect()->route('post.index');


    }

    public function destroy(Post $post, Request $request) {


        $this->authorize('delete', $post);

        $post->delete();

        $request->session()->flash('message', 'Post was deleted');

        return back();

    }

    public function edit(Post $post) {

        $this->authorize('view', $post);

        return view('admin.posts.edit', ['post'=>$post]);

    }

    public function update(Post $post) {

        $inputs = request()->validate([
            'title' => '|min:8|max:255',
            'post_image' => 'file|',
            'body' => '',
        ]);

        if(request('post_image')) {
            $inputs['post_image'] = request('post_image')->store('images');
            $post->post_image = $inputs['post_image'];
        }

        $post->title = $inputs['title'];
        $post->body = $inputs['body'];

        $this->authorize('update', $post);

        $post->update();

        session()->flash('post-updated-message', 'Post was updated tile : '. $inputs['title']);

        return redirect()->route('post.index');


    }


}
