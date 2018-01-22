@extends('layouts.admin')

@section('content')

	<h1>Create New API</h1>

		{!! Form::open(['action'=>'ContentApiController@store']) !!}
		<div class="form-group">
			{!! Form::label('api_name','Api Name:')!!}
			{!! Form::text('api_name',null,['placeholder'=>'Api Name','class'=>'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::submit('Create Api',['class'=>'btn btn-primary'])!!}
		</div>
		
	{!! Form::close() !!}

	@include('components.errors')

@endsection