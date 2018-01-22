<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
	protected $fillable = ['path','filename','fileable_type','fileable_id'];
	protected $uploads = '/storage/';

    public function fileable(){
    	return $this->morphTo();
    }

    public function getPathAttribute($file){
    	return $this->uploads.$file;
    }
}
