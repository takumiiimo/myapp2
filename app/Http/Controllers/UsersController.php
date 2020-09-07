<?php

namespace App\Http\Controllers;

use App\User;
use App\CreatorPost;
use App\ModelPost;
use Auth;
use Validator;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    // コンストラクタ 新しいオブジェクトが生成されると最初に実行されるメソッド
    public function __construct()
    {
        // ログイン状態を判断するミドルウェア
        $this->middleware('auth');
    }
    
    public function show($user_id)
    {
        $user = User::where('id', $user_id)
        ->firstOrFail();
        
        if($user->role == 'creator'){
            $posts = CreatorPost::limit(100)
            ->orderBy('created_at','desc')
            ->get();
        }
        
        if($user->role == 'model'){
            $posts = ModelPost::limit(100)
            ->orderBy('created_at','desc')
            ->get();
        }

        return view('user/show', ['user' => $user , 'posts' => $posts]);
    }
    
    public function edit()
    {
        $user = Auth::user();
        
        return view('user/edit', ['user' => $user]);
    }
    
    public function update(Request $request)
    {
        
        $validator = Validator::make($request->all() , [
            'user_name' => 'required|string|max:255',
            'user_password' => 'required|string|min:6|confirmed',
            ]);
            
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        $user = User::find($request->id);
        $user->name = $request->user_name;
        $user->gender = $request->user_gender;
        $user->aria = $request->user_aria;
        $user->introduction = $request->user_introduction;
        if ($request->user_profile_photo !=null) {
            // 第一引数(public/user_images)に保存 
            $request->user_profile_photo->storeAs('public/user_images', $user->id . '.jpg');
            $user->profile_photo = $user->id . '.jpg';
        }
        $user->password = bcrypt($request->user_password);
        
        $user->save();
        
        // 詳細画面に遷移される
        return redirect('/users/'.$request->id);
    }
}
