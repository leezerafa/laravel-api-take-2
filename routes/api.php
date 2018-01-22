<?php
use App\Post;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'v1','middleware' => 'apiauth'], function(){

	Route::get('/post/{id}', function ($id) {
    	return new PostResource(Post::find($id));
	});	

	Route::get('/posts', function () {
    	return new PostResource(Post::all());
	});	
});
