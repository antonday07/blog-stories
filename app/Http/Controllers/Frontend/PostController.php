<?php

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Traits\CategoryTagList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;



class PostController extends Controller
{
    use CategoryTagList;

    public function __construct()
    {

    }

    public function index() {
        $posts = Post::latest()->paginate(5);
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post) {
        //dd(Category::all()->pluck('title')->toArray());
       // dd($post->categories()->pluck('title')->toArray());

        return view('posts.show', [
            'post' => $post,
            'categories' => $post->categoriesList(),
            'tags' => $post->tagsList()

        ]);
    }
    public function create() {
        return view('posts.create', [
            'categories' => Category::all(),
            'tags' => Tag::all()
        ]);
    }

    public function edit(Post $post) {
        $this->authorize('update', $post);

       // dd($post->categories->pluck('id')->toArray());
        return view('posts.edit', [
            'post' => $post,
            'categories' => Category::all(),
            'tags' => Tag::all()
        ]);
    }

    public function store(Request $request) {
//        $array = $request->get('categories');
//        dd(explode(':', $array[0]));

        $attributes = $request->validate([
            'title' => 'required|string|unique:posts|min:5|max:100',
            'summary' => 'required|string|min:5|max:2000',
            'content' => 'required|string',
        ]);
        $attributes['slug'] = Str::of($attributes['title'])->slug('-');
       $attributes = array_merge($attributes, [
            'user_id' => current_user_id()
        ]);

        $post = Post::create($attributes);

        // Create Category - Post table

        $categories = $request->get('categories');
        $tags = $request->get('tags');
        if ($categories != null && $tags != null) {
            $this->createCategory($categories, $post);
            $this->createTag($tags, $post);

        }

        return redirect()->route('posts.show', $post)->with('notification', 'Post created successfully !');

    }

    public function update(Request $request, Post $post) {

        $this->authorize('update', $post);
       // dd($request->get('categories'));
        $attributes = $request->validate([
            'title' => 'required|string|unique:posts|min:5|max:100',
            'summary' => 'required|string|min:5|max:2000',
            'content' => 'required|string',
        ]);
        $attributes['slug'] = Str::of($attributes['title'])->slug('-');
        $attributes = array_merge($attributes, [
            'user_id' => current_user_id()
        ]);


        $post->update($attributes);

        // Update Category - Post table
        $categories = $request->get('categories');
        $tags = $request->get('tags');
        if ($categories != null && $tags != null) {
            $this->createCategory($categories, $post);
            $this->createTag($tags, $post);

        }

        return redirect()->route('posts.show', $post)->with('notification', 'Post updated successfully !');

    }

    public function destroy(Post $post) {

        $this->authorize('update', $post);

        $post->delete();

        return back()->with('notification', 'Post deleted successfully !');
    }
}
