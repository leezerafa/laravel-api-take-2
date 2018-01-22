@extends('layouts.blog-post')

@section('content')

	<!-- Blog Post -->

	<!-- Title -->
	<h1>{{$post->title}}</h1>

	<!-- Author -->
	<p class="lead">
	    by <a href="#">{{$post->author->name}}</a>
	</p>

	<hr>

	<!-- Date/Time -->
	<p><span class="glyphicon glyphicon-time"></span> Posted on {{ $post->created_at->diffForHumans()}}</p>

	<hr>

	<!-- Preview Image -->
	<img class="img-responsive" src="{{ $post->files->last() ? asset($post->files->last()->path) : 'http://placehold.it/120x120'}}">

	<hr>

	<!-- Post Content -->
	<p class="lead">{{$post->body}}</p>

	<hr>

	<!-- Blog Comments -->
	@if(Session::has('comment_message'))
		{{session('comment_message')}}
	@endif
	<!-- Comments Form -->
	<div class="well">
	    <h4>Leave a Comment:</h4>
		{!! Form::open(['method'=>'post','action'=>'PostCommentController@store']) !!}
			<div class="form-group">
				{!! Form::textarea('body',null,['class'=>'form-control','rows'=>3]) !!}
				{!! Form::hidden('post_id',$post->id) !!}
			</div>
			<div class="form-group">
				{!! Form::submit('Submit Comment',['class'=>'btn btn-primary']) !!}
			</div>
		{!! Form::close() !!}
	</div>

	<hr>

	<!-- Posted Comments -->

	<!-- Comment -->
	@if(Auth::check())
		@foreach($post->comments as $comment)

			<div class="media">
			    <a class="pull-left" href="#">
			        <img class="media-object" src="{{ $comment->user->files->last() ? asset($comment->user->files->last()->path) : 'http://placehold.it/64x64'}}">
			    </a>
			    <div class="media-body">
			        <h4 class="media-heading">{{$comment->user->name}}
			            <small>{{$comment->created_at->diffForHumans()}}</small>
			        </h4>
			        {{$comment->body}}

		        	<div class="media">
	        		    <h4>Leave a Comment:</h4>
	        			{!! Form::open(['method'=>'post','action'=>'CommentRepliesController@store']) !!}
	        				<div class="form-group">
	        					{!! Form::textarea('body',null,['class'=>'form-control','rows'=>3]) !!}
	        					{!! Form::hidden('comment_id',$comment->id) !!}
	        				</div>
	        				<div class="form-group">
	        					{!! Form::submit('Submit Reply',['class'=>'btn btn-primary']) !!}
	        				</div>
	        			{!! Form::close() !!}
		        	    <a class="pull-left" href="#">
		        	        <img class="media-object" src="http://placehold.it/64x64" alt="">
		        	    </a>
		        	    <div class="media-body">
							
							@foreach($comment->replies as $reply)
								<a class="pull-left" href="#">
								    <img class="media-object" src="{{ $reply->user->files->last() ? asset($reply->user->files->last()->path) : 'http://placehold.it/64x64'}}">
								</a>
								<h4 class="media-heading">{{$reply->user->name}}
								    <small>{{$reply->created_at->diffForHumans()}}</small>
								</h4>
								{{$reply->body}}
							@endforeach




		        	    </div>
		        	</div>
			    </div>
			</div>
		@endforeach
	@endif




	<!-- Comment -->
	<div class="media">
	    <a class="pull-left" href="#">
	        <img class="media-object" src="http://placehold.it/64x64" alt="">
	    </a>
	    <div class="media-body">
	        <h4 class="media-heading">Start Bootstrap
	            <small>August 25, 2014 at 9:30 PM</small>
	        </h4>
	        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
	        <!-- Nested Comment -->
	        <div class="media">
	            <a class="pull-left" href="#">
	                <img class="media-object" src="http://placehold.it/64x64" alt="">
	            </a>
	            <div class="media-body">
	                <h4 class="media-heading">Nested Start Bootstrap
	                    <small>August 25, 2014 at 9:30 PM</small>
	                </h4>
	                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
	            </div>
	        </div>
	        <!-- End Nested Comment -->
	    </div>
	</div>

@endsection