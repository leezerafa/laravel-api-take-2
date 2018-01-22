@extends('layouts.admin')

@section('content')
	<h1>Edit</h1>
		<div class="col-sm-3">
			<img src="{{ $post->files->last() ? asset($post->files->last()->path) : 'http://placehold.it/120x120'}}">
		</div>
		<div class="col-sm-9">
			{!! Form::model($post,['route'=>['posts.update',$post],'files'=>true,'method'=>'patch']) !!}
				<div class="form-group">
					{!! Form::label('title','Title:')!!}
					{!! Form::text('title',$post->title,['placeholder'=>'Title','class'=>'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('body','Post Body:')!!}
					{!! Form::textarea('body',$post->body,['placeholder'=>'Post Body','class'=>'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('photo_id','Post Photo') !!}
					{!! Form::file('photo_id') !!}
				</div>
				<div class="form-group">
					<ul>
						@foreach($categories as $id=>$name)
						<li>
							{!! Form::label('cats[]',$name) !!}
							{!! Form::checkbox('cats[]',$id, in_array($id,$post->categories->pluck('id')->toArray()) ? true : false ) !!}
						</li>
					@endforeach
					</ul>
				</div>
				<div class="form-group">
					{!! Form::submit('Update Post',['class'=>'btn btn-primary'])!!}
				</div>
			{!! Form::close() !!}

			{!! Form::open(['method'=>'delete','route'=>['posts.destroy',$post->id]])!!}
				<div class="form-group">
					{!! Form::submit('Delete Post',['class'=>'btn btn-danger'])!!}
				</div>
			{!! Form::close() !!}
		</div>

	

	@include('components.errors')

@endsection