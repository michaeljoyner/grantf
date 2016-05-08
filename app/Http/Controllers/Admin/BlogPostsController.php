<?php

namespace App\Http\Controllers\Admin;

use App\Blog\Post;
use App\Http\FlashMessaging\Flasher;
use App\Http\Requests\BlogPostRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BlogPostsController extends Controller
{

    /**
     * @var Flasher
     */
    private $flasher;

    public function __construct(Flasher $flasher)
    {
        $this->flasher = $flasher;
    }

    public function index()
    {
        $posts = Post::latest()->paginate(10);

        return view('admin.blog.index')->with(compact('posts'));
    }

    public function create()
    {
        $post = new Post;

        return view('admin.blog.create')->with(compact('post'));
    }

    public function store(Request $request)
    {
        $this->validate($request, ['title' => 'required|max:255']);

        $post = $request->user()->addPost($request->only(['title', 'description', 'body']));

        return redirect('admin/blog/posts/' . $post->id . '/edit');
    }

    public function edit(Post $post)
    {
        return view('admin.blog.edit')->with(compact('post'));
    }

    public function update(BlogPostRequest $request, Post $post)
    {
        $post->update($request->only(['title', 'description', 'body']));

        $this->flasher->success('All good', 'Post has been updated!');

        return redirect('admin/blog/posts');
    }

    public function publish(Request $request, Post $post)
    {
        $this->validate($request, ['publish' => 'boolean']);

        $post->setPublishedStatus($request->publish);

        return response()->json(['new_state' => !!$post->published]);
    }

    public function delete(Post $post)
    {
        $post->delete();

        $this->flasher->success('Gone!', 'The post has been deleted.');

        return redirect('admin/blog/posts');
    }
}
