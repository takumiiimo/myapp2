<?php

namespace App\Http\Controllers;

use App\ModelPost;
use Auth;
use Validator;

use Illuminate\Http\Request;

class ModelPostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $posts = ModelPost::limit(100)
        ->orderBy('created_at','desc')
        ->get();
        
        return view('post/model/index',['posts' => $posts]);
    }
    public function new()
    {
        return view('post/model/new');
    }
    public function store(Request $request)
    {
        // 入力値のチェック
        $validator = Validator::make($request->all(),['caption' => 'required|max:255','photo' => 'required']);
        
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        
        $post = new ModelPost;
        $post->caption = $request->caption;
        $post->user_id = Auth::user()->id;
        
        $post->save();
        
        $request->photo->storeAs('public/post_images',$post->id.'.jpg');
        
        return redirect('/model');
    }
    
    public function destory($post_id)
    {
        $post = ModelPost::find($post_id);
        $post->delete();
        return redirect('/model');
    }
}
