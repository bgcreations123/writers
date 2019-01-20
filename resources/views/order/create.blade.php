@extends('layouts.master')

@section('title', 'New Project')

@section('content')

	{!! Form::open(['route' => 'order.store']) !!}

	<div class="form-group">
	    {!! Form::label('name', 'Your Name') !!}
	    {!! Form::text('name', null, ['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
	    {!! Form::label('email', 'E-mail Address') !!}
	    {!! Form::text('email', null, ['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
	    {!! Form::textarea('msg', null, ['class' => 'form-control']) !!}
	</div>

	{!! Form::submit('Submit', ['class' => 'btn btn-info']) !!}

	{!! Form::close() !!}

@endsection