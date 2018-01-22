@extends('layouts.admin')

@section('content')
	@if(Session::has('deleted_post'))
		<p class="bg-danger">{{ session('deleted_post') }}</p>
	@endif
	<h1>Categories</h1>

	<table class="table">
		<thead>
			<tr>
				<th>Category Id</th>
				<th>Name</th>
				<th>Created</th>
				<th>Updated</th>
				<th>Edit</th>
			</tr>
		</thead>
		<tbody>
			@if($categories)
				@foreach($categories as $category)
					<tr>
						<td>{{ $category->id}}</td>
						<td>{{ $category->name }}</td>
						<td>{{ $category->created_at->diffForHumans()}}</td>
						<td>{{ $category->updated_at->diffForHumans()}}</td>
						<td><a href="{{ route('categories.edit',$category->id) }}">Edit Post</a></td>
					</tr>

				@endforeach
			@endif
		</tbody>
	</table>

@endsection