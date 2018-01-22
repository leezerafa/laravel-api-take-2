<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Resources\PostResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ApiController extends Controller
{
    public function getPost($id){

    	if(empty($id)){
    		return jsend_fail(['id' => 'The post id is empty']);
    	}

    	try {
    	    $post = new PostResource(Post::findOrFail($id));
    	} catch (ModelNotFoundException $e) {
    	    return jsend_error('Unable to find post: '.$e->getMessage());
    	}

    	return jsend_success($post);
    }

    public function getPosts(){
    	
    	try {
    	    $posts = PostResource::collection(Post::all());
    	} catch (ModelNotFoundException $e) {
    	    return jsend_error('Unable to find posts: '.$e->getMessage());
    	}

    	return jsend_success($posts);
    }
}
