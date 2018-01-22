@extends('layouts.admin')

@section('content')
	@if(Session::has('deleted_post'))
		<p class="bg-danger">{{ session('deleted_post') }}</p>
	@endif
	<h1>Posts</h1>

	<table class="table">
		<thead>
			<tr>
				<th>Post Id</th>
				<th>Title</th>
				<th>Body</th>
				<th>Author</th>
				<th>Created</th>
				<th>Updated</th>
				<th>View</th>
				<th>Edit</th>
			</tr>
		</thead>
		<tbody>
			@if($posts)
				@foreach($posts as $post)
					<tr>
						<td>{{$post->id}}</td>
						<td>{{ $post->title }}</td>
						<td>{{ $post->body }}</td>
						<td>{{ $post->author->name }}</li>
						<td>{{ $post->created_at->diffForHumans()}}</td>
						<td>{{ $post->updated_at->diffForHumans()}}</td>
						<td><a href="{{ route('home.post',$post->id)}}">View Post<a/></td>
						<td><a href="{{ route('posts.show',$post->id)}}">View Comment<a/></td>
						<td><a href="{{ route('posts.edit',$post->id) }}">Edit Post</a></td>
					</tr>

				@endforeach
			@endif
		</tbody>
	</table>

@endsection