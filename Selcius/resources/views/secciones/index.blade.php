@extends('main')
@section('title', '| Secciones')

@section('content')
@if(Auth::user()->level == 2)
<div class="row">
		<div class="col-md-10 col-md-offset-1">
		<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
			<p class="text-center" style="font-size: 30px;font-family: 'Quicksand', sans-serif;"><i class="fa fa-folder"></i> Secciones</p>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Icono</th>
						<th>Nombre</th>
						<th style="width: 40px">Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach($sections as $section)
					<tr>
						<th>
							{{$section->id}}
						</th>
						<th><img src="{{asset('images/'.$section->icono)}}" style="width: 42px;height: 42px;border-radius: 50%;margin-right: 10px;" class="responsive-img"></th>
						<td>
							<a href="{{route('sections.show', $section->id)}}">{{$section->name}} </a>
						</td>
						<td><a href="{{route('sections.edit', $section->id)}}" class="btn-flat waves-effect"><i class="fa fa-pencil"></i></a></td>
						<td>

						{!! Form::open(['route' => ['sections.destroy', $section->id], 'method' => 'DELETE']) !!}
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
			{!! Form::open(['route' => 'sections.store', 'method' => 'POST', 'files' => 'true'])!!}
			<p class="text-center" style="font-size: 30px;font-family: 'Quicksand', sans-serif;"><i class="fa fa-plus"></i> Nueva sección</p>
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
				<br>
				<button class="btn waves-effect waves-light blue" type="submit" name="action">send
    				<i class="material-icons right">send</i>
  				</button>
			</div>
			{!! Form::close()!!}
	</div>
@else
<div class="row">
	<div class="col-md-10 col-md-offset-1">
	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
		<p style="font-size: 30px;font-family: 'Quicksand', sans-serif;" class="text-center"><i class="fa fa-puzzle-piece"></i> Secciones</p>
			@foreach($sections as $section)
				<a href="{{route('sections.show', $section->id)}}"><div style="float:center;" class="chip">
					<img src="{{asset('images/'.$section->icono)}}" class="circle responsive-img">{{$section->name}}
				</div></a>
			@endforeach
	</div>
</div>
@endif
@endsection
