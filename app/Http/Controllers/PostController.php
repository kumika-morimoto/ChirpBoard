<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Like;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts=Post::latest()->paginate(20);
        return view('posts.index',compact('posts'));
    }

    public function myposts()
    {
        $posts=Auth::user()->posts()->latest()->paginate(20);
        return view('posts.myposts',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'body'=>'required|max:140',
        ]);

        Auth::user()->posts()->create([
            'body'=>$request->body,
        ]);

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post=Post::where('id',$id)->where('user_id',Auth::id())->firstOrFail();
        return view('posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'body'=>'required|max:140',
        ]);

        $post=Post::where('id',$id)->where('user_id',Auth::id())->firstOrFail();
        $post->body=$request->body;
        $post->save();
        return redirect()->route('posts.myposts');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post=Post::where('id',$id)
        ->where('user_id',Auth::id())
        ->firstOrFail();
        $post->delete();
        return redirect()->route('posts.myposts');
    }
    
    public function toggle($id)
    {
        //対象の投稿を取得
        $post=Post::findOrFail($id);
        //既にいいねしているか確認
        $existing=like::where('user_id',Auth::id())->where('post_id',$id)->first();
        if($existing){
            //既にいいねしている場合はレコード削除
            $existing->delete();
        }else{
            //いいねしていない場合はレコード作成
            Like::create([
                'user_id'=>Auth::id(),
                'post_id'=>$id,
            ]);
        }
        //元のページに戻る
        return back();
    }
}
