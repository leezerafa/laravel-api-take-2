@extends('layouts.admin')

@section('content')
	@if(Session::has('comment_deleted'))
		<p class="bg-danger">{{ session('comment_deleted') }}</p>
	@endif
	@if(Session::has('comment_approved'))
		<p class="bg-success">{{ session('comment_approved') }}</p>
	@endif
	<h1>Comments</h1>

	<table class="table">
		<thead>
			<tr>
				<th>Comment Id</th>
				<th>Post Id</th>
				<th>Author</th>
				<th>Email</th>
				<th>Body</th>
				<th>Created At</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			@if($comments)
				@foreach($comments as $comment)
					<tr>
						<td>{{ $comment->id}}</td>
						<td><a href="{{ route('home.post',$comment->post_id)}}">View Post</a></td>
						<td>{{ $comment->author}}</td>
						<td>{{ $comment->email}}</td>
						<td>{{ $comment->body}}</td>
						<td>{{ $comment->created_at->diffForHumans()}}</td>
						<td>
							@if($comment->is_active == 0)
								{!! Form::open(['method'=>'patch','route'=>['comments.update',$comment]])!!}
									{!! Form::hidden('is_active',1) !!}
									{!! Form::submit('Approve Comment',['class'=>'btn btn-primary']) !!}
								{!! Form::close() !!}
							@else
								{!! Form::open(['method'=>'patch','route'=>['comments.update',$comment]])!!}
									{!! Form::hidden('is_active',0) !!}
									{!! Form::submit('Un-approve Comment',['class'=>'btn btn-primary']) !!}
								{!! Form::close() !!}
							@endif
							
						

						</td>
						<td>
							{!! Form::open(['method'=>'delete','route'=>['comments.destroy',$comment]])!!}
								{!! Form::submit('Delete Comment',['class'=>'btn btn-danger']) !!}
							{!! Form::close() !!}
						</td>
					</tr>

				@endforeach
			@endif
		</tbody>
	</table>

@endsection