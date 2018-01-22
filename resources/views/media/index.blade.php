@extends('layouts.admin')



@section('content')

	<h1>Media</h1>

	@if($files)
	<table class="table">
		<thead>
			<tr>
				<th>Id</th>
				<th>Thumbnail</th>
				<th>Filename</th>
				<th>Type</th>
				<th>Type Id</th>
				<th>Created</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>

			@foreach($files as $file)
				<tr>
					<td>{{$file->id}}</td>
					<td><img src="{{asset($file->path)}}"></td>
					<td>{{$file->filename}}</td>
					<td>{{$file->fileable_type}}</td>
					<td>{{$file->fileable_id}}</td>
					<td>{{$file->created_at}}</td>
					<td>{!! Form::open(['method'=>'delete','route'=>['media.destroy',$file->id]])!!}
							<div class="form-group">
								{!! Form::submit('Delete File',['class'=>'btn btn-danger'])!!}
							</div>
						{!! Form::close() !!}
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	@endif
@endsection