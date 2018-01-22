@extends('layouts.admin')

@section('content')
	<h1>Create</h1>

		{!! Form::open(['action'=>'AdminUsersController@store','files'=>true]) !!}
		<div class="form-group">
			{!! Form::label('name','Name:')!!}
			{!! Form::text('name',null,['placeholder'=>'Name','class'=>'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('email','Email:')!!}
			{!! Form::text('email',null,['placeholder'=>'Email','class'=>'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('is_active','Status:')!!}
			{!! Form::select('is_active', [1 => 'Active',0 => 'Not Active'],null,['class'=>'form-control'] )!!}
		</div>
		<div class="form-group">
			{!! Form::label('role_id','Role_id:')!!}
			{!! Form::select('role_id', [' ' => 'Select Role'] + $roles,null,['class'=>'form-control'] )!!}
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
			{!! Form::submit('Create User',['class'=>'btn btn-primary'])!!}
		</div>
	{!! Form::close() !!}

	@include('components.errors')

@endsection