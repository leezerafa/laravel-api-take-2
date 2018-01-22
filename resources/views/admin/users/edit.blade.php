@extends('layouts.admin')

@section('content')
	<h1>Edit</h1>
		<div class="col-sm-3">
			<img src="{{ $user->files->last() ? asset($user->files->last()->path) : 'http://placehold.it/120x120'}}">
		</div>
		<div class="col-sm-9">
			{!! Form::model($user,['route'=>['users.update',$user],'files'=>true,'method'=>'patch']) !!}
				<div class="form-group">
					{!! Form::label('name','Name:')!!}
					{!! Form::text('name',$user->name,['placeholder'=>'Name','class'=>'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('email','Email:')!!}
					{!! Form::text('email',$user->email,['placeholder'=>'Email','class'=>'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('is_active','Status:')!!}
					{!! Form::select('is_active', [1 => 'Active',0 => 'Not Active'],null,['class'=>'form-control'] )!!}
				</div>
				<div class="form-group">
					{!! Form::label('role_id','Role_id:')!!}
					{!! Form::select('role_id', $roles,null,['class'=>'form-control'] )!!}
				</div>
				<div class="form-group">
					{!! Form::label('password','Password:')!!}
					{!! Form::password('password',['class'=>'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('photo_id','Account Portrait') !!}
					{!! Form::file('photo_id') !!}
				</div>
				<div class="form-group">
					{!! Form::submit('Update User',['class'=>'btn btn-primary'])!!}
				</div>
			{!! Form::close() !!}

			{!! Form::open(['method'=>'delete','route'=>['users.destroy',$user->id]])!!}
				<div class="form-group">
					{!! Form::submit('Delete User',['class'=>'btn btn-danger'])!!}
				</div>
			{!! Form::close() !!}
		</div>

	

	@include('components.errors')

@endsection