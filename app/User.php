<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','is_active','role_id','path','filename','api_user_key'
    ];

    protected $table = 'users';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role(){
       return $this->belongsTo('App\Role');
    }

    public function files(){
        return $this->morphMany('App\File','fileable');
    }

    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function replies(){
        return $this->hasMany('App\CommentReply');
    }

    public function api(){
        return $this->hasOne('App\ContentApi');
    }

    public function setPasswordAttribute($value){
        $this->attributes['password'] = trim(Hash::make($value));
    }

    public function setApiUserKeyAttribute($value){
        $salt = 'Il0veApiz';
        $rand = rand(5,10);
        $this->attributes['api_user_key'] = trim(Hash::make($rand.$value.$salt));
    }

    public function isAdmin(){
        if($this->role->name == 'Admin'){
            return true;
        }
        return false;
    }

    public function isActive(){
        if($this->is_active == 1){
            return true;
        }
        return false;
    }

    public function verifyUserApiKey($key){
        if($this->api_user_key == $key){
            return true;
        }
        return false;
    }

    public function verifyUserContentApiKey($key){
        if($this->api->api_key == $key){
            return true;
        }
        return false;
    }
}
