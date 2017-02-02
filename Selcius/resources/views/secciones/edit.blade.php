@extends('main')
<?php $titleTag = htmlspecialchars($section->name); ?>

@section('title', "| $titleTag")

@section('content')
@if(Auth::user()->level == 2)
<div class="row">
	{!! Form::model($section, ['route' => ['sections.update', $section->id], 'data-parsley-validate' => '','method' => 'PUT', 'files' => 'true'])!!}
	<div class="col-md-8 col-md-offset-2">
	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
		<p style="font-family: 'Quicksand', sans-serif;font-size: 30px;" class="text-center">Editar sección: <img src="{{asset('images/'.$section->icono)}}" style="width: 42px;height: 42px;border-radius: 50%;margin-right: 10px;" class="responsive-img"> {{$section->name}}</p>
		<br>
		<div class="input-field col s6">
			<i class="fa fa-folder prefix"></i>
					<label for="name">Nombre</label>
			<input type="text" id="name" name="name">
		</div>
		<div class="file-field input-field col s6">
			<div class="btn">
				<span>File</span>
				<input name="featured_icono" type="file">
			</div>
			<div class="file-path-wrapper">
				<input class="file-path validate" type="text">
			</div>
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
<p class="text-center"><i class="fa fa-folder fa-5x" aria-hidden="true"></i></p>
<p class="text-center" style="font-family: 'Comfortaa', cursive;font-size: 40px;">Edit Sections</p>
<p class="text-center" style="font-family: 'Comfortaa', cursive;font-size: 40px;">Solo administradores</p>
@endif
@endsection
