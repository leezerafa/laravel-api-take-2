@extends('layouts.admin')

@section('styles')
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.css">
@endsection

@section('content')

	<h1>Upload Files</h1>

	{!! Form::open(['method'=>'post', 'action'=>'FileController@store','class'=>'dropzone','id'=>'uploadfiles']) !!}
	{!! Form::close()!!}
	
@endsection



@section('scripts')
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.js"></script>
@endsection