@extends('layouts.admin')

@section('content')
	<h1>Edit Category</h1>

		<div class="col-sm-9">
			{!! Form::model($category,['route'=>['categories.update',$category],'method'=>'patch']) !!}
				<div class="form-group">
					{!! Form::label('name','Category Name:')!!}
					{!! Form::text('name',$category->name,['placeholder'=>'Name','class'=>'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::submit('Update Category',['class'=>'btn btn-primary'])!!}
				</div>
			{!! Form::close() !!}

			{!! Form::open(['method'=>'delete','route'=>['categories.destroy',$category->id]])!!}
				<div class="form-group">
					{!! Form::submit('Delete Category',['class'=>'btn btn-danger'])!!}
				</div>
			{!! Form::close() !!}
		</div>
	@include('components.errors')

@endsection