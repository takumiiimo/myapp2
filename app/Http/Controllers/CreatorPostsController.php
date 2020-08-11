<?php

namespace App\Http\Controllers;

use App\CreatorPost;
use Auth;
use Validator;

use Illuminate\Http\Request;

class CreatorPostsController extends Controller
{
    public function __construct()
    {
        // ログインしていなかったらログインページへ
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = CreatorPost::limit(100)
        ->orderBy('created_at','desc')
        ->get();
        
        return view ('post/creator/index',['posts' => $posts]);
    }
    public function new()
    {
        return view('post/creator/new');
    }
    public function store(Request $request)
    {
        // 入力値のチェック
        $validator = Validator::make($request->all() , ['caption' => 'required|max:255', 'photo' => 'required']);
        
        // エラーの場合
        if ($validator->fails())
        {
            // 入力値の値を保持したまま前の画面に戻る
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        
        $post = new CreatorPost;
        $post->caption = $request->caption;
        $post->user_id = Auth::user()->id;
        $post->save();
        
        $request->photo->storeAs('public/post_images',$post->id.'.jpg');
        
        return redirect('/creator');
    }
        
    public function destory($post_id)
    {
        $post = CreatorPost::find($post_id);
        $post->delete();
        return redirect('/creator');
    }
    
}
