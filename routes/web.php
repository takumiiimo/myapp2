<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// トップページ
Route::get('/','PostsController@top')->name('top');
Route::get('/home','PostsController@top');

Auth::routes();

// クリエイターのトップページ
Route::get('/creator/','CreatorPostsController@index');
// モデルのトップページ
Route::get('/model/','ModelPostsController@index');

// Route::get('/home', 'HomeCcd ontroller@index')->name('home');

// ユーザー編集画面
Route::get('/users/edit', 'UsersController@edit');

// ユーザー更新画面
Route::post('/users/update', 'UsersController@update');

// ユーザー詳細画面
Route::get('/users/{user_id}', 'UsersController@show');


// クリエイター投稿新規画面
Route::get('/creator/posts/new', 'CreatorPostsController@new')->name('creator_new');

// クリエイター投稿新規処理
Route::post('/creator/posts', 'CreatorPostsController@store');

// クリエイター投稿削除処理
Route::get('/postsdelete/{creator_post_id}', 'CreatorPostsController@destroy');

// モデル投稿新規画面
Route::get('/model/posts/new', 'ModelPostsController@new')->name('model_new');

// モデル投稿新規処理
Route::post('/model/posts', 'ModelPostsController@store');

// モデル投稿削除処理
Route::get('/model/postsdelete/{post_id}', 'ModelPostsController@destroy');

Route::get('/matching', 'MatchingController@index')->name('matching');

Route::post('/chat/show', 'ChatController@show')->name('chat.show');

Route::post('/chat/chat', 'ChatController@chat')->name('chat.chat');