@extends('main')
@section('title', '| Artículos')
@section('content')
@if(Auth::user()->level == 2)
<p class="flow-text text-center" style="font-size: 40px;">Artículos <a href="{{ route('articulos.create') }}" class="btn-floating btn-large waves-effect waves-light red" style="float:right;"><i class="material-icons">add</i></a></p>
{!!$chart->render()!!}
{!!$donut->render()!!}
<div class="row">
	<div class="col-md-13">
		<table class="striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Título</th>
					<th>Creado el</th>
					<th>Autor</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach($articulos as $articulo)
					<tr>
						<td>{{ $articulo->id }}</td>
						<td>{{ $articulo->title }}</td>
						<td>{{date('M j, Y h:ia', strtotime( $articulo->created_at))}}</td>
						<td><a href="{{'auth.profiles', $articulo->user->id}}">{{$articulo->user->name}}</a></td>
						<td><a href="{{ route('articulos.show', $articulo->id) }}" style="margin-right: 10px;"><i class="fa fa-arrow-right"></i></a>
						@if(Auth::user()->id != $articulo->user_id)

						@else
						<a href="{{ route('articulos.edit', $articulo->id)}}"><i class="fa fa-pencil"></i></a></td>
						@endif
					</tr>
				@endforeach
			</tbody>
		</table>
		<div class="text-center">
			{!! $articulos->links(); !!}
		</div>
	</div>
</div>
@endif
@endsection
