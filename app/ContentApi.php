<?php

namespace App;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Eloquent\Model;

class ContentApi extends Model
{
    protected $fillable = ['api_name','api_key','user_id'];

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function setApiKeyAttribute($value){
    	$salt = 'Il0veApiz';
    	$rand = rand(5,10);
        $this->attributes['api_key'] = trim(Hash::make($rand.$value.$salt));
    }
}
