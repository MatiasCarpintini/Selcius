@extends('main')
@section('title', '| Editar tags')
@section('content')
@if(Auth::user()->level == 2)
<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
<div class="row">
	{!! Form::model($tag, ['route' => ['tags.update', $tag->id], 'data-parsley-validate' => '','method' => 'PUT'])!!}
	<div class="col-md-8 col-md-offset-2">
	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
		<p style="font-family: 'Quicksand', sans-serif;font-size: 30px;" class="text-center">Editar tag: {{$tag->name}}</p>
		<br>
		<div class="input-field col-md-offset-1">
			<i class="prefix fa fa-puzzle-piece"></i>
			<label for="name1">Nuevo nombre</label>
			<input type="text" id="name1" name="name">
		</div>
		<br>
		<button class="btn waves-effect waves-light blue" type="submit" name="action">enviar
			<i class="material-icons right">send</i>
		</button>
		<br>
	{!! Form::close()!!}
	</div>
</div>
@else
<link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
<p class="text-center"><i class="fa fa-tags fa-5x" aria-hidden="true"></i></p>
<p class="text-center" style="font-family: 'Comfortaa', cursive;font-size: 40px;">Edit Tag</p>
<p class="text-center" style="font-family: 'Comfortaa', cursive;font-size: 40px;">Solo administradores</p>
@endif
@endsection
