<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\File;
use App\Http\Requests\UserRequest;
use App\Http\Requests\EditUserRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::all();

        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','id')->all();

        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User;
        $input = $request->all();
        $input['api_user_key'] = $request->password.$request->email;

        $newUserId = $user->create($input)->id;
        $createdUser = User::find($newUserId);

        if($fileData = $request->file('photo_id')){
           $fileName = $fileData->getClientOriginalName();
           $fileSaveData =  $fileData->store('user-photos','public');
           $createdUser->files()->create(['path'=>$fileSaveData,'filename'=>$fileName]);
        }

       return redirect('/admin/users/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::pluck('name','id')->all();

        return view('admin.users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUserRequest $request, $id)
    {   
        $user = User::findOrFail($id);
        $user->update($request->all());

        if($fileData = $request->file('photo_id')){
           $fileName = $fileData->getClientOriginalName();
           $fileSaveData =  $fileData->store('user-photos','public');
           $user->files()->create(['path'=>$fileSaveData, 'filename'=>$fileName]);
        }
        
        return redirect('/admin/users'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $file = $user->files->last()->path;
        Storage::disk('public')->delete(str_replace('/storage/','',$file));
        $user->delete();
        $user->files()->delete();
        Session::flash('deleted_user','The user has been deleted!');
        return redirect('/admin/users');

    }
}
