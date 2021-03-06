<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\str;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::where('user_id',Auth::id())->orderBy('created_at','desc')->paginate(2);

        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags =  Tag::all();

        return view('admin.posts.create',compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();

        $request->validate([
            'title' => 'required|min:5|max:200',
            'body' => 'required|min:5|max:500',
            'img' => 'image'           
        ]);

        $data['user_id'] = Auth::id();
        $data['slug'] = Str::slug($data['title'],'-');
        
        if (!empty($data['img'])) {
            $data['img'] = Storage::disk('public')->put('images', $data['img']);
        }

        $postNew = new Post;

        $postNew->fill($data);

        $saved = $postNew->save();

        if ((array_key_exists('tags', $data))) {
            $postNew->tags()->attach($data['tags']);
        }

        if ($saved) {
            return redirect()->route('posts.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags =  Tag::all();

        return view('admin.posts.edit',compact('post','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        
        $data = $request->all();

        $request->validate([
            'title' => 'required|min:5|max:200',
            'body' => 'required|min:5|max:500',  
            'img' => 'image'         
        ]);

        $data['user_id'] = Auth::id();
        $data['slug'] = Str::slug($data['title'],'-');
        $data['updated_at'] = Carbon::now('Europe/Rome');


        if ((array_key_exists('tags', $data))) {
            $post->tags()->sync($data['tags']);
        }  else {
            $post->tags()->detach();
        }

        if (!empty($data['img'])) {
            if (!empty($post->img)) {
                Storage::disk('public')->delete($post->img);
            }
            $data['img'] = Storage::disk('public')->put('images', $data['img']);
        }
        
        $post->update($data);

        if ($post) {
            return redirect()->route('posts.index')->with('session',"L'elemento $post->title è stato modificato correttamente");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $delete = $post->delete();

        if ($delete) {
            return redirect()->route('posts.index',)->with('session',"Elemento $post->title eliminato correttamente!");
        } else {
            return redirect()->route('posts.index')->with('session',"L'elemento $post->title non è stato eliminato correttamente!");
        }
        
    }
}
