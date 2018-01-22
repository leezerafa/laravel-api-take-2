@extends('layouts.admin')

@section('content')

	<h1>Create Category</h1>

		{!! Form::open(['action'=>'CategoryController@store','files'=>true]) !!}
		<div class="form-group">
			{!! Form::label('name','Category Name:')!!}
			{!! Form::text('name',null,['placeholder'=>'Category Name','class'=>'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::submit('Create Post',['class'=>'btn btn-primary'])!!}
		</div>
		
	{!! Form::close() !!}

	@include('components.errors')

@endsection