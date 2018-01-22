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

//Useing custom middleware apiauth
Route::group(['prefix' => 'v1','middleware' => 'apiauth'], function(){

	Route::get('/post/{id}','ApiController@getPost');	
	Route::get('/posts','ApiController@getPosts');

	Route::fallback(function(){
    	return response()->json(['status' => 'failed', 'data' => null, 'message' => 'End Point not found']);
	});
});
