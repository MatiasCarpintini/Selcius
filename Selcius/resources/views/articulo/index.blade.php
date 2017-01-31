@extends('main')
@section('title', '| Artículos')
@section('content')

<div class="row">
	@foreach($articulos as $articulo)
	<article>
		<div class="col-md-4">
			<a href="{{route('articulo.single', $articulo->slug)}}"><div class="card hoverable">
				<div class="card-image">
					<img src="{{asset('images/'.$articulo->image)}}">
					<span class="card-title"><p>{{$articulo->title}}</p></span>
				</div>
				<div class="card-content">
					<p style="color: black;">{{substr(strip_tags($articulo->body), 0, 150)}}{{strlen(strip_tags($articulo->body)) > 150 ? '...' : ""}}</p>
				</div>
				<li class="divider"></li>
				<br>
				<a href="{{route('auth.profiles', $articulo->user->id)}}"><p><img src="{{asset('avatars/'.$articulo->user->image)}}" style="width: 42px;height: 42px;border-radius: 50%;margin-right: 10px;margin-left: 20px;"> By {{$articulo->user->name}}</p></a>
				<br>
			</div></a>
		</div>
	</article>
	@endforeach
</div>
<div class="row">
	<div class="col-md-12">
		<div class="text-center">
			{!! $articulos->links() !!}
		</div>
	</div>
</div>

@endsection

