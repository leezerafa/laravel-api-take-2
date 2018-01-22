<?php
use App\Post;
use App\Http\Resources\PostResource;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/post/{id}',['as'=>'home.post','uses'=>'AdminPostsController@post']);


Route::group(['middleware' => 'admin'], function(){

	Route::get('/admin',function(){
		return view('admin.index');
	});

	Route::resource('admin/users','AdminUsersController');
	Route::resource('admin/posts','AdminPostsController');
	Route::resource('admin/categories','CategoryController');
	Route::resource('admin/media','FileController');
	Route::resource('admin/comments','PostCommentController');
	Route::resource('admin/comments/replies','CommentRepliesController');
	Route::resource('admin/api','ContentApiController');


});

