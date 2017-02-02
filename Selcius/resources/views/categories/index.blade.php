@extends('main')
@section('title', '| Categorías')
@section('content')
@if(Auth::user()->level == 2)
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
		<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
			<p class="text-center" style="font-size: 30px;font-family: 'Quicksand', sans-serif;"><i class="fa fa-puzzle-piece"></i> Categorías</p>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Nombre</th>
						<th style="width: 40px">Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach($categories as $category)
					<tr>
						<th>
							{{$category->id}}
						</th>
						<td>
							<a href="{{route('categories.show', $category->id)}}">{{$category->name}} </a>
						</td>
						<td><a href="{{route('categories.edit', $category->id)}}" class="btn-flat waves-effect"><i class="fa fa-pencil"></i></a></td>
						<td>

						{!! Form::open(['route' => ['categories.destroy', $category->id], 'method' => 'DELETE']) !!}
						<button type="submit" class="btn-flat waves-effect"><i class="material-icons">delete</i></button>
						{!! Form::close()!!}
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			<br>
			<li class="divider"></li>
			<br>
			{!! Form::open(['route' => 'categories.store', 'method' => 'POST'])!!}
			<p class="text-center" style="font-size: 30px;font-family: 'Quicksand', sans-serif;"><i class="fa fa-plus"></i> Nueva categoría</p>
			<br>
			<div class="col-md-10 col-md-offset-2">

				<div class="input-field col s6">
				  <i class="fa fa-puzzle-piece prefix"></i>
		          <label for="name">Nombre</label>
				  <input type="text" id="name" name="name">
		        </div>
				<br>
				<button class="btn waves-effect waves-light blue" type="submit" name="action">enviar
    				<i class="material-icons right">send</i>
  				</button>
			</div>
			{!! Form::close()!!}
		</div>
	</div>
@else
<div class="row">
	<div class="col-md-10 col-md-offset-1">
	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
		<p style="font-size: 30px;font-family: 'Quicksand', sans-serif;" class="text-center"><i class="fa fa-puzzle-piece"></i> Categorías</p>
			@foreach($categories as $category)
				<a href="{{route('categories.show', $category->id)}}"><div style="float:center;" class="chip">
					{{$category->name}}
				</div></a>
			@endforeach
	</div>
</div>
@endif
<script>
var categories_delete = '{{url('categories.destroy'. $category->id)}}';
</script>
@endsection
