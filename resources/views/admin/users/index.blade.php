@extends('layouts.admin')

@section('content')
	@if(Session::has('deleted_user'))
		<p class="bg-danger">{{ session('deleted_user') }}</p>
	@endif
	<h1>Users</h1>

	<table class="table">
		<thead>
			<tr>
				<th>User ID</th>
				<th>Photo</th>
				<th>Role</th>
				<th>Name</th>
				<th>Email</th>
				<th>Api User Key</th>
				<th>Created</th>
				<th>Updated</th>
				<th>Edit</th>
			</tr>
		</thead>
		<tbody>
			@if($users)
				@foreach($users as $user)
					<tr>
						<td>{{$user->id}}</td>
						<td>
							<img width="50" height="50" src="{{ $user->files->last() ? asset($user->files->last()->path) : 'http://placehold.it/120x120'}}">
						</td>
						<td>{{ $user->role->name }}</td>
						<td>{{ $user->name }}</td>
						<td>{{ $user->email }}</li>
						<td>{{ $user->api_user_key }}</td>
						<td>{{ $user->created_at->diffForHumans()}}</td>
						<td>{{ $user->updated_at->diffForHumans()}}</td>
						<td><a href="{{ route('users.edit',$user->id) }}">Edit User</a></td>
					</tr>

				@endforeach
			@endif
		</tbody>
	</table>

@endsection