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

Route::get('/', function () {return view('welcome');})->name('welcome');
// 第三方登录
Route::get('/oauth/{name}', 'ThirdPartyAuthController@redirectToProvider')->name('oauth');
Route::get('/oauth/{name}/callback', 'ThirdPartyAuthController@handleProviderCallback');

Route::get('/logout',function(\Illuminate\Http\Request $request){
    Auth::guard()->logout();
    $request->session()->invalidate();
    return redirect('/');
})->name('logout');

Route::get('/login',function(){
    return redirect(route('oauth',['name' => 'github']));
})->name('login');


Route::resource('article', 'ArticleController');
Route::resource('comment', 'CommentController');
Route::resource('share', 'ShareController');
Route::resource('collection', 'CollectionController');
Route::resource('diary', 'DiaryController');

Route::get('/tags/all.json', function(){
    return App\Tag::all();
})->name('get.tags.all');


Route::get('/articles','ArticleController@articles')->name('articles');
Route::get('/shares','ShareController@shares')->name('shares');
Route::get('/diaries','DiaryController@diaries')->name('diaries');
Route::get('/pictures',function(){return "pictures";})->name('pictures');
Route::get('/collections','CollectionController@collections')->name('collections');


Route::get('/article/favorite/{id}','ArticleController@favorite')->name('article.favorite');
Route::get('/article/favorite/detach/{id}','ArticleController@detachFavorite')->name('article.detach.favorite');
Route::get('/article/trash/{id}','ArticleController@trash')->name('article.trash');

Route::get('/share/trash/{id}','ShareController@trash')->name('share.trash');
Route::get('/collection/trash/{id}','CollectionController@trash')->name('collection.trash');
Route::get('/diary/trash/{id}','DiaryController@trash')->name('diary.trash');


Route::any('/picture/upload','PictureController@upload')->name('picture.upload');