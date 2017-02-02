@extends('main')
<?php $titleTag = htmlspecialchars($articulo->title); ?>
@section('title', "| $titleTag")
@section('content')
@if(Auth::guest())
@else
@if(Auth::user()->level == 2)
<div class="row">
	<div class="col-md-8">
		<img class="materialboxed responsive-img" src="{{asset('images/'.$articulo->image)}}">
		<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
		<p style="font-size: 35px;font-family: 'Ubuntu', sans-serif;">{{ $articulo->title }}</p>
		<p class="lead">{!! $articulo->body !!}}</p>
		<hr>
		<div class="tags">
			@foreach($articulo->tags as $tag)

			<span class="label label-default">
				{{ $tag->name }}
			</span>

		@endforeach
	</div>
	<div id="backend-comments" style="margin-top: 50px;">
	<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
		<p style="font-size: 35px;font-family: 'Varela Round', sans-serif;color: #33b5e5;" class="text-center"><i class="fa fa-comments-o"></i> {{ $articulo->comments()->count() }} Comentarios</p>
			<table class="bordeder">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>E-mail</th>
						<th>Creado el</th>
						<th>Actualizado el</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach($articulo->comments as $comment)
					<tr>
						<td><a href="{{route('auth.profiles', $comment->user->id)}}"><img src="{{asset('avatars/'.$comment->user->image)}}" style="width: 42px;height: 42px;border-radius: 50%;margin-right: 10px;">{{ $comment->user->name }} </a></td>
						<td>{{ $comment->user->email }}</td>
						<td>{{date('M j, Y h:ia', strtotime($comment->created_at))}}</td>
						<td>{{date('M j, Y h:ia', strtotime($comment->updated_at))}}</td>
						<td>
							{!!Form::open(['route' => ['comments.destroy', $comment->id], 'method' => 'DELETE'])!!}
							<a href="{{ route('comments.edit', $comment->id) }}" style="margin-right: 10px;"><i class="glyphicon glyphicon-pencil"></i></a>
							<button type="submit"><i class="glyphicon glyphicon-trash"></i></button>
							{!!Form::close()!!}
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-md-4">
		<div class="well">
			<dl class="dl-horizontal">
				<a href="{{route('auth.profiles', $articulo->user->id)}}"><p class="text-center"><img src="{{asset('avatars/'.$articulo->user->image)}}" class="responsive-img" style="width: 42px;height: 42px;border-radius: 50%;margin-right: 10px;">{{$articulo->user->name}}</p></a>
			</dl>
			<dl class="dl-horizontal">
				<p><i class="fa fa-unlink"></i> Slug: <a href="{{ route('articulo.single', $articulo->slug) }}">{{route('articulo.single', $articulo->slug)}}</a></p>
			</dl>
			<dl class="dl-horizontal">
				<p><i class="fa fa-puzzle-piece"></i> Categoría: {{$articulo->category->name}}</p>
			</dl>
			<dl class="dl-horizontal">
				<p><i class="fa fa-clock-o"></i> Creado el: {{date('M j, Y h:ia', strtotime($articulo->created_at))}}</p>
			</dl>
			<dl class="dl-horizontal">
				<p><i class="fa fa-clock-o"></i> Última actualización: {{date('M j, Y h:ia',strtotime($articulo->updated_at))}}</p>
			</dl>
			<li class="divider"></li>
			<br>
			<div class="row">
				<div class="col-sm-6">
					{!! Form::open(['route' => ['articulos.destroy', $articulo->id], 'method' => 'DELETE']) !!}
						<button type="submit" class="waves-effect waves-light btn red"><i class="fa fa-trash right"></i> eliminar</button>
					{!! Form::close()!!}
				</div>
				<div class="col-sm-6">
					<a href="{{route('articulos.edit', $articulo->id)}}" class="btn blue waves-effect waves-light"><i class="fa fa-pencil right"></i> editar</a>
				</div>
			</div>
			<div class="col-md-12 text-center">
				<a href="{{route('articulos.index')}}" class="waves-effect waves-light default btn"><i class="fa fa-newspaper-o right"></i> artículos</a>
			</div>
			<br>
			<br>
		</div>
	</div>
</div>
@endif
@endif
@endsection
