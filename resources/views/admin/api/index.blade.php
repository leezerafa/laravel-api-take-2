@extends('layouts.admin')

@section('content')
	@if(Session::has('deleted_api'))
		<p class="bg-danger">{{ session('deleted_api') }}</p>
	@endif
	<h1>Api</h1>

	<table class="table">
		<thead>
			<tr>
				<th>Api Id</th>
				<th>Api Name</th>
				<th>Api Key</th>
				<th>Created</th>
				<th>Updated</th>
				<th>Edit</th>
			</tr>
		</thead>
		<tbody>
			@if($apis)
				@foreach($apis as $api)
					<tr>
						<td>{{ $api->id}}</td>
						<td>{{ $api->api_name }}</td>
						<td>{{ $api->api_key }}</td>
						<td>{{ $api->created_at->diffForHumans()}}</td>
						<td>{{ $api->updated_at->diffForHumans()}}</td>
						<td><a href="{{ route('api.edit',$api->id) }}">Edit Api</a></td>
					</tr>

				@endforeach
			@endif
		</tbody>
	</table>

@endsection