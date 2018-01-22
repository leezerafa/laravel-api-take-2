<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title','body','user_id'];
    protected $table = 'posts';


    public function author(){
    	return $this->belongsTo('App\User','user_id');
    }

    public function categories(){
    	return $this->belongsToMany('App\Category');
    }

    public function files(){
    	return $this->morphMany('App\File','fileable');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }
}
