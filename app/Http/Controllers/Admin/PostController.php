<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Lead;
use App\Mail\NewContact;


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
        return view('admin.posts.index',compact('posts'));
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
        return view('admin.posts.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $form_data = $request->validated();

        $slug = Post::generateSlug($request->title);

        $form_data['slug']=$slug;

        $newPost = new Post();

        if($request->has('cover_image')){
            $path = Storage::disk('public')->put('post_images',$request->cover_image);

            $form_data['cover_image']=$path;
            
        }

        $newPost->fill($form_data);

        $newPost->save();

        if($request->has('tags')){
            $newPost->tags()->attach($request->tags);
        }

        $new_lead = new Lead();
        $new_lead->title = $form_data['title'];
        $new_lead->content = $form_data['content'];
        $new_lead->slug = $form_data['slug'];

        $new_lead->save();

        Mail::to('info@boolpress.com')->send(new NewContact($new_lead));


        return redirect()->route('admin.posts.index')->with('message','post creato correttamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit',compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $form_data=$request->validated();
        $slug = Post::generateSlug($request->title, '-');
        $form_data['slug'] = $slug;

        if($request->hasfile('cover_image')){

            if($post->cover_image){
                Storage::delete($post->cover_image);
            }

            $path = Storage::disk('public')->put('post_images',$request->cover_image);

            $form_data['cover_image']=$path;
            
        }

        $post->update($form_data);

        if($request->has('tags')){

            $post->tags()->sync($request->tags);
         
        }

        return redirect()->route('admin.posts.index')->with('message', 'Hai modificato correttamente il post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->tags()->sync([]);

        $post->delete();

        $post->delete();

        return redirect()->route('admin.posts.index')->with('message','Il Post è stato cancellato correttamente');
    }
}
