<?php

namespace App\Http\Controllers;

use App\CommentReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CommentRepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commentReplies = CommentReply::all();
        return view('admin.comments.index',compact('commentReplies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $data = [
            'comment_id' => $request->comment_id,
            'user_id'    => $user->id,
            'body'       => $request->body
        ];

        CommentReply::create($data);
        $request->session()->flash('comment_message','Your comment has been submitted and is awaiting moderation');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(CommentReply $commentReplies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(CommentReply $commentReplies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommentReply $commentReplies)
    {

        CommentReply::findOrFail($commentReplies->id)->update($request->all());
        $message = 'The comment has been approved';
        if($request->is_active == 0){
            $message = 'The comment has been un-approved';
        }
        $request->session()->flash('comment_approved',$message);
           
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommentReply $commentReplies)
    {
        CommentReply::findOrFail($commentReplies->id)->delete();
        Session::flash('comment_deleted','The comment has been deleted');
        return redirect()->back();
    }
}
