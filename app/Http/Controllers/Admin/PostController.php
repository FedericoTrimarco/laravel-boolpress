<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $tags = Tag::all();
        // dump($tags);

        return view('admin.posts.index', compact('posts', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        // dump($tags);
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id',
        ]);

        $data = $request->all();
        // dump($data);
        // dd($data); -> dump che stoppa la funzione

        // creazione nuovo post
        $new_post = new Post();
        
        // gen slug univoco
        $slug = Str::slug($data['title'], '-');
        $count = 2;
        $base_slug = $slug;

        while (Post::where('slug', $slug)->first()) {
            $slug = $base_slug . '-' . $count;
            $count++;
        }

        $data['slug'] = $slug;
        $new_post->fill($data);

        $new_post->save();

        //SALVA IN PIVOT RELAZIONE TRA NUOVO POST CON TAGS SELZ. DELLA FORM
        if (array_key_exists('tags', $data)) {
            $new_post->tags()->attach($data['tags']);   
        }

        return redirect()->route('admin.posts.show', $new_post->slug); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        // dump($post->category);
        // dump($post->tags);

        if(! $post) {
            abort(404);
        }
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        $tags = Tag::all();

        if(! $post) {
            abort(404);
        }

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id',
        ]);

        $data = $request->all();
        // dump($data);

        // update recod
        $post = Post::find($id);

        if ($data['title'] != $post->title) {
            $slug = Str::slug($data['title'], '-');
            $count = 2;
            $base_slug = $slug;

            while (Post::where('slug', $slug)->first()) {
                $slug = $base_slug . '-' . $count;
                $count++;
            }

            $data['slug'] = $slug;
        } else {
            $data['slug'] = $post->slug;
        }

        $post->update($data);

        if (array_key_exists('tags', $data)) {
            $post->tags()->sync($data['tags']);
        } else {
            $post->tags()->detach();
        }
        return redirect()->route('admin.posts.show', $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect()->route('admin.posts.index')->with('deleted', $post->title);
    }
}
