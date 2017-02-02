@extends('main')
@section('title', '| Tags')
@section('content')
@if(Auth::user()->level == 2)
<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<p style="font-size: 30px;font-family: 'Quicksand', sans-serif;" class="text-center"><i class="fa fa-tags"></i> Tags</h1>
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Nombre</th>
					<th style="width: 40px;">Acciones</th>
				</tr>
			</thead>
			<tbody>
			@foreach($tags as $tag)
				<tr>
					<th>
						{{$tag->id}}
					</th>
					<td>
						<a href="{{route('tags.show', $tag->id)}}">{{$tag->name}}</a>
					</td>
					<td><a href="{{route('tags.edit', $tag->id)}}" class="btn-flat waves-effect"><i class="fa fa-pencil"></i></a></td>
					<td>
						{!! Form::open(['route' => ['tags.destroy', $tag->id], 'method' => 'DELETE']) !!}
						<button type="submit" class="btn-flat waves-effect"><i class="material-icons">delete</i></button>
						{!! Form::close()!!}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<br>
		<div id="create-tag">
		{!! Form::open(['route' => 'tags.store', 'method' => 'POST'])!!}
		<p class="text-center" style="font-size: 30px;font-family: 'Quicksand', sans-serif;"><i class="fa fa-plus"></i> Nuevo tag</p>
		<section style="padding-bottom: 40px;padding-left: 200px;">
			<div class="input-field col s6">
				<label for="name">Nombre</label>
				<input type="text" name="name" id="name">
			</div>
			<br>
			<button class="btn waves-effect waves-light submit blue" type="submit" name="action">enviar
				<i class="material-icons right">send</i>
			</button>
		</section>
		{!! Form::close()!!}
		</div>
	</div>
</div>
@else
<div class="row">
	<div class="col-md-10 col-md-offset-1">
	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
		<p style="font-size: 30px;font-family: 'Quicksand', sans-serif;" class="text-center"><i class="fa fa-tags"></i> Tags</p>
		@foreach($tags as $tag)
			<div class="chip">
				<a href="{{route('tags.show', $tag->id)}}"> {{$tag->name}} </a>
			</div>
		@endforeach
	</div>
</div>
@endif
<script>
var url = '{{url('tags.store')}}';
</script>
@endsection
