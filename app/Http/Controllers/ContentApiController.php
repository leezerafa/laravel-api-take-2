<?php

namespace App\Http\Controllers;

use App\ContentApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContentApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $apis = ContentApi::all();
        return view('admin.api.index',compact('apis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.api.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input['api_name'] = $request->api_name;
        $input['user_id'] = Auth::user()->id;
        $input['api_key'] = $request->api_name;
        // print_r($input);
        ContentApi::create($input);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ContentApi  $contentApi
     * @return \Illuminate\Http\Response
     */
    public function show(ContentApi $contentApi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContentApi  $contentApi
     * @return \Illuminate\Http\Response
     */
    public function edit(ContentApi $contentApi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContentApi  $contentApi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContentApi $contentApi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContentApi  $contentApi
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContentApi $contentApi)
    {
        //
    }
}
