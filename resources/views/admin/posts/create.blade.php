@extends('layouts.admin')

@section('content')

	<h1>Create Post</h1>

		{!! Form::open(['action'=>'AdminPostsController@store','files'=>true]) !!}
		<div class="form-group">
			{!! Form::label('title','Post Title:')!!}
			{!! Form::text('title',null,['placeholder'=>'Post Title','class'=>'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('body','Post Body:')!!}
			{!! Form::textarea('body',null,['placeholder'=>'Post Body','class'=>'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('photo_id','Account Portrait') !!}
			{!! Form::file('photo_id') !!}
		</div>
		<div class="form-group">
			<ul>
				@foreach($categories as $id=>$name)
				<li>
					{!! Form::label('cats[]',$name) !!}
					{!! Form::checkbox('cats[]',$id) !!}
				</li>
			@endforeach
			</ul>
			
		</div>
		<div class="form-group">
			{!! Form::submit('Create Post',['class'=>'btn btn-primary'])!!}
		</div>
		
	{!! Form::close() !!}

	@include('components.errors')

@endsection