<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::all();
        return view('home', ['posts' => $posts]);
    }

    public function create()
    {
        return view('home');
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $id = Auth::id();
        //インスタンス作成
        $post = new Post();
        
        $post->content = $request->content;
        $post->user_id = $id;

        $post->save();

       return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $post = Post::find($id);
        $user = DB::table('users')->first();
        
        return view('post.detail', ['post' => $post,'user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */

    public function edit($id) {
        $post = Post::find($id);

        return view('post.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request) {
        $inputs = $request->all();
        // dd($inputs);
        \DB::beginTransaction();

        try {
            //code...
            //更新！！
            $post = Post::find($inputs['id']);
            $post->fill([
                'content' => $inputs['content']
            ]);
            $post->save();
            \DB::commit();
        } catch (\Throwable $th) {
            \DB::rollback();
            abort(500);
        }

        return redirect(route('home'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */

     public function delete($id) {

        try {
            //code...
            //本を削除
            Post::destroy($id);
        } catch (\Throwable $th) {
            abort(500);
        }

        return redirect(route('home'));
     }
}
